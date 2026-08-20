<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\Produk\StoreRequest;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');
        
        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->paginate(12) // Menggunakan kelipatan 4 agar grid 4 kolom simetris
            ->withQueryString();
        } else {
            $products = Produk::latest()->paginate(12)->withQueryString();
        }
       
        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data['user_id']    = Auth::id();        
        $data['nama']       = $dataReq['name'];        
        $data['harga_beli'] = $dataReq['purchase_price'];        
        $data['harga_jual'] = $dataReq['selling_price'];        
        $data['stok']       = $dataReq['stock'] ?? 0;        
        
        // Set foto default jika user tidak mengunggah file
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        } else {
            $data['foto'] = 'products/default.jpg';
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),        
            'nama'       => $dataReq['name'],      
            'harga_beli' => $dataReq['purchase_price'],        
            'harga_jual' => $dataReq['selling_price'],       
            'stok'       => $dataReq['stock'],       
        ];  

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama (jika ada & bukan foto default)
            if (
                $produk->foto &&
                $produk->foto !== 'products/default.jpg' &&
                Storage::disk('public')->exists($produk->foto)
            ) {
                Storage::disk('public')->delete($produk->foto);
            }
            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        try {
            // Cek apakah produk memiliki relasi ke item_penjualan
            if ($produk->itemPenjualan()->exists()) {
                return redirect()->route('produk.index')
                    ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi penjualan. Silakan nonaktifkan produk ini saja.');
            }

            // Hapus foto jika ada (dan bukan default)
            if ($produk->foto && $produk->foto !== 'products/default.jpg' && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $produk->delete();

            return redirect()->route('produk.index')
                ->with('success', 'Product deleted successfully.');
                
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('produk.index')
                ->with('error', 'Gagal menghapus produk karena terikat dengan data transaksi.');
        }
    }
}