<?php

namespace App\Http\Controllers;

use App\Http\Requests\Penjualan\CheckoutRequest;
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

    public function rekap()
    {
        $harian = Penjualan::query()
            ->where('status', 'COMPLETED')
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah_transaksi, SUM(total_pembayaran) as total_penjualan')
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at) DESC')
            ->limit(30)
            ->get();

        $bulanan = Penjualan::query()
            ->where('status', 'COMPLETED')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as jumlah_transaksi, SUM(total_pembayaran) as total_penjualan')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
            ->orderByRaw('DATE_FORMAT(created_at, "%Y-%m") DESC')
            ->limit(12)
            ->get();

        $tahunan = Penjualan::query()
            ->where('status', 'COMPLETED')
            ->selectRaw('YEAR(created_at) as tahun, COUNT(*) as jumlah_transaksi, SUM(total_pembayaran) as total_penjualan')
            ->groupByRaw('YEAR(created_at)')
            ->orderByRaw('YEAR(created_at) DESC')
            ->get();

        $totalHariIni = Penjualan::where('status', 'COMPLETED')
            ->whereDate('created_at', now()->toDateString())
            ->sum('total_pembayaran');

        $totalBulanIni = Penjualan::where('status', 'COMPLETED')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_pembayaran');

        $totalTahunIni = Penjualan::where('status', 'COMPLETED')
            ->whereYear('created_at', now()->year)
            ->sum('total_pembayaran');

        return view('penjualan.rekap', compact(
            'harian',
            'bulanan',
            'tahunan',
            'totalHariIni',
            'totalBulanIni',
            'totalTahunIni'
        ));
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
    public function update(CheckoutRequest $request, Penjualan $penjualan)
    {
        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        $isGreetingCardOrder = $request->boolean('ada_kartu_ucapan');

        if ($penjualan->itemPenjualan()->count() === 0 && ! $isGreetingCardOrder) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // Hitung total murni dari subtotal item keranjang
        $totalBarang = (float) $penjualan->itemPenjualan()->sum('subtotal');
        $hargaPerTangkai = $isGreetingCardOrder ? (float) $request->input('harga_per_tangkai', 0) : 0;
        $jumlahTangkai = $isGreetingCardOrder ? (int) $request->input('jumlah_tangkai', 0) : 0;
        $biayaKartuUcapan = $isGreetingCardOrder ? ($jumlahTangkai * $hargaPerTangkai) : 0;
        $total = $totalBarang + $biayaKartuUcapan;
        
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

        DB::transaction(function () use ($penjualan, $request, $total, $bayar, $kembalian, $biayaKartuUcapan, $isGreetingCardOrder, $jumlahTangkai, $hargaPerTangkai) {
            $penjualan->update([
                'metode_pembayaran'  => $request->payment_method,
                'total_pembayaran'   => $total,
                'bayar'              => $bayar,
                'kembalian'          => $kembalian,
                'status'             => 'COMPLETED',
                'ada_kartu_ucapan'   => $isGreetingCardOrder,
                'pengirim'           => $isGreetingCardOrder ? $request->input('pengirim') : null,
                'penerima'           => $isGreetingCardOrder ? $request->input('penerima') : null,
                'bunga'              => $isGreetingCardOrder ? $request->input('bunga') : null,
                'jumlah_tangkai'     => $jumlahTangkai,
                'harga_per_tangkai'  => $hargaPerTangkai,
                'biaya_kartu_ucapan' => $biayaKartuUcapan,
                'hiasan'             => $isGreetingCardOrder ? $request->input('hiasan') : null,
                'kartu_ucapan'       => $isGreetingCardOrder ? $request->input('kartu_ucapan') : null,
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