<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // Filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'bayar'             => 0,
                'kembalian'         => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        // Update otomatis total_pembayaran berdasarkan isi keranjang saat ini
        $total = $sale->itemPenjualan()->sum('subtotal');
        $sale->update(['total_pembayaran' => $total]);

        $keyword = $request->input('search');

        // Pencarian berdasarkan nama ATAU kode barcode
        if ($keyword) {
            $products = Produk::where('nama', 'like', '%' . $keyword . '%')
                ->orWhere('barcode', $keyword)
                ->orderBy('nama')
                ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan;

        $sale->load(['itemPenjualan.produk', 'user']);
        $products = Produk::orderBy('nama')->get();
        $mode = 'view';

        return view('penjualan.detail', compact('sale', 'products', 'mode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'bayar'          => 'required_if:payment_method,CASH|nullable',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // Hitung total murni dari subtotal item keranjang
        $total = (float) $penjualan->itemPenjualan()->sum('subtotal');
        
        // Bersihkan input nominal bayar jika mengandung titik atau karakter selain angka
        $rawBayar = $request->input('bayar');
        $cleanBayar = preg_replace('/[^0-9]/', '', (string) $rawBayar);

        if ($request->payment_method === 'QRIS') {
            $bayar = $total;
        } else {
            $bayar = (float) ($cleanBayar ?: 0);
        }

        // Validasi uang tunai tidak boleh kurang dari total
        if ($request->payment_method === 'CASH' && $bayar < $total) {
            return back()->with('errors', 'Uang pembayaran kurang dari total belanja');
        }

        // Hitung selisih kembalian
        $kembalian = $bayar - $total;

        DB::transaction(function () use ($penjualan, $request, $total, $bayar, $kembalian) {
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'bayar'             => $bayar,
                'kembalian'         => $kembalian,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.show', $penjualan->id)
            ->with('success', 'Transaksi berhasil diselesaikan. Kembalian: Rp ' . number_format($kembalian, 0, ',', '.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        // Pastikan hanya transaksi OPEN
        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            // Eager load relasi produk agar tidak lambat saat query increment stok
            $penjualan->load('itemPenjualan.produk');

            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            // Hapus item keranjang dan data penjualan
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}