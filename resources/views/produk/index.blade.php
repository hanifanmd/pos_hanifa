@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Flower Shop Pink Styling for Produk -->
<style>
    .page-wrapper {
        background-color: #fffafb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-product {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(255, 117, 140, 0.2);
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(255, 182, 193, 0.15);
        background: #ffffff;
        overflow: hidden;
    }
    .search-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(255, 182, 193, 0.1);
    }
    .table-custom thead {
        background: linear-gradient(135deg, #ff758c 0%, #ff9a9e 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .product-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(255, 182, 193, 0.25);
    }
    .badge-price-buy {
        background-color: #fce4ec;
        color: #880e4f;
        padding: 5px 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-price-sell {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 5px 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .badge-stock {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #6b4c58;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(254, 214, 227, 0.5);
    }
    .btn-create-product {
        background: #ffffff;
        color: #ff758c;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-create-product:hover {
        background: #4a3b42;
        color: #ffffff;
    }
    .btn-detail-custom {
        background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-edit-custom {
        background: linear-gradient(135deg, #ffe259 0%, #ffa751 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
    .btn-delete-custom {
        background: linear-gradient(135deg, #ff758c 0%, #ff4b2b 100%);
        border: none;
        color: #fff;
        border-radius: 8px;
        font-weight: 500;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner Floral Theme -->
        <div class="hero-banner-product p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-danger px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🌸 Manajemen Persediaan Toko Bunga
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Halaman Produk</h1>
                <p class="text-white mb-0 opacity-75">Kelola daftar buket, harga, stok, dan informasi inventaris bunga lainnya.</p>
            </div>
            <div class="mt-3 mt-md-0">
                @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-create-product btn-lg shadow-sm px-4">
                    + Tambah Produk
                </a>
                @endcan
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- ALERT SECTION --}}
        {{-- ========================================== --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- ========================================== --}}

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4 search-box">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0 text-danger ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 bg-white py-2 px-2"
                        placeholder="Cari nama produk bunga..."
                    >
                    <button class="btn btn-primary px-4 fw-semibold" type="submit" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%); border: none;">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary px-3">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card Floral -->
        <div class="card custom-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">User</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Harga Beli</th>
                            <th scope="col" class="py-3">Harga Jual</th>
                            <th scope="col" class="py-3">Stok</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <th scope="row" class="ps-4 fw-bold text-muted">{{ $products->firstItem() + $loop->index }}</th>
                            <td>
                                <span class="fw-semibold text-dark"><i class="bi bi-person-circle me-1 text-danger"></i> {{ $product->user->name }}</span>
                            </td>
                            <td>
                                <img src="{{ asset('storage/'.$product->foto) }}" class="product-img" alt="{{ $product->nama }}">
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $product->nama }}</span>
                            </td>
                            <td>
                                <span class="badge-price-buy">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="badge-price-sell">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="badge-stock">{{ $product->stok }} pcs</span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 justify-content-center">
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-detail-custom btn-sm px-3">Rincian</a>
                                    
                                    @can('update', $product)
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-edit-custom btn-sm px-3">Edit</a>
                                    @endcan
                                    
                                    @can('delete', $product)
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-delete-custom btn-sm px-3" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted fs-5">Data tidak tersedia.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection