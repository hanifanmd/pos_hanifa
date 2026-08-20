@extends('layouts.app')

@section('title', 'Manajemen Produk - Etalase Bunga')

@section('content')

@include('layouts.navbar')

<!-- Custom Magenta Theme Styling for Produk Cards -->
<style>
    .page-wrapper {
        background-color: #fff9fb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-product {
        background: #a8204d; /* Disesuaikan ke warna magenta/maroon elegan */
        border-radius: 20px;
        color: #fff;
        box-shadow: 0 10px 25px rgba(168, 32, 77, 0.2);
    }
    .search-box {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(168, 32, 77, 0.08);
        border: 1px solid #f2c7d4;
    }
    
    /* Strict Grid Layout Solution */
    .product-grid {
        display: flex;
        flex-wrap: wrap;
    }
    .product-grid > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }

    /* Product Card Styling */
    .product-card {
        border: 1px solid #f7d3df;
        border-radius: 20px;
        background: #ffffff;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(168, 32, 77, 0.15);
        border-color: #a8204d;
    }
    .product-img-wrapper {
        position: relative;
        width: 100%;
        height: 220px;
        flex-shrink: 0;
        overflow: hidden;
        background-color: #fff4f7;
    }
    .product-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card:hover .product-card-img {
        transform: scale(1.08);
    }
    
    /* Badges & Overlays */
    .badge-stock {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: #a8204d;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 6px 14px;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }
    .badge-user {
        font-size: 0.75rem;
        background-color: #fff4f7;
        color: #a8204d;
        border-radius: 50px;
        padding: 4px 10px;
        display: inline-block;
    }
    .price-tag-sell {
        font-size: 1.15rem;
        font-weight: 800;
        color: #2e7d32;
    }

    /* Buttons */
    .btn-create-product {
        background: #ffffff;
        color: #a8204d;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-create-product:hover {
        background: #f7d3df;
        color: #901a40;
    }
    .btn-action {
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 6px 12px;
        transition: all 0.2s ease;
    }
    .btn-detail-custom {
        background: #e3f2fd;
        color: #0288d1;
        border: none;
    }
    .btn-detail-custom:hover {
        background: #0288d1;
        color: #fff;
    }
    .btn-edit-custom {
        background: #fff8e1;
        color: #f57c00;
        border: none;
    }
    .btn-edit-custom:hover {
        background: #f57c00;
        color: #fff;
    }
    .btn-delete-custom {
        background: #ffebee;
        color: #c62828;
        border: none;
    }
    .btn-delete-custom:hover {
        background: #c62828;
        color: #fff;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner Floral Theme -->
        <div class="hero-banner-product p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm" style="color: #a8204d !important;">
                    🌸 Manajemen Persediaan Toko Bunga
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Etalase Produk</h1>
                <p class="text-white mb-0 opacity-75">Kelola koleksi buket bunga, harga, stok, dan informasi produk dengan mudah.</p>
            </div>
            <div class="mt-3 mt-md-0">
                @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn btn-create-product btn-lg shadow-sm px-4">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                </a>
                @endcan
            </div>
        </div>

        <!-- Flash Message Alerts -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 border-0 rounded-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="card p-2 mb-4 search-box">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0 ps-3" style="color: #a8204d;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-0 bg-transparent py-2 px-2 shadow-none"
                        placeholder="Cari nama produk bunga..."
                    >
                    <button class="btn px-4 fw-semibold rounded-pill text-white" type="submit" style="background: #a8204d; border: none;">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary px-3 rounded-pill ms-2">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Etalase Product Grid -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4 product-grid">
            @forelse ($products as $product)
                <div class="col">
                    <div class="card product-card">
                        
                        <!-- Image Container with Stock Badge -->
                        <div class="product-img-wrapper">
                            @if($product->foto)
                                <img src="{{ asset('storage/'.$product->foto) }}" class="product-card-img" alt="{{ $product->nama }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                            <span class="badge-stock">
                                <i class="bi bi-box-seam me-1"></i> {{ $product->stok }} pcs
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column p-3">
                            <div class="mb-2">
                                <span class="badge-user">
                                    <i class="bi bi-person-fill me-1"></i>{{ $product->user->name ?? 'Admin' }}
                                </span>
                            </div>

                            <h5 class="card-title fw-bold text-dark fs-6 mb-2 text-truncate" title="{{ $product->nama }}">
                                {{ $product->nama }}
                            </h5>

                            <!-- Pricing -->
                            <div class="mt-auto pt-2 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Harga:</small>
                                    <span class="price-tag-sell">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer Action Buttons -->
                        <div class="card-footer bg-white border-0 pt-0 pb-3 px-3">
                            <div class="d-flex gap-1 justify-content-between">
                                <a href="{{ route('produk.show', $product) }}" class="btn btn-action btn-detail-custom flex-grow-1 text-center">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-action btn-edit-custom flex-grow-1 text-center">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                @endcan

                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-action btn-delete-custom w-100" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 w-100">
                    <div class="card p-5 text-center border-0 rounded-4 shadow-sm" style="background: #ffffff;">
                        <div class="text-muted fs-5">
                            <i class="bi bi-flower1 display-4 opacity-50 d-block mb-3" style="color: #a8204d;"></i>
                            Belum ada produk bunga yang tersedia.
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination Footer -->
        <div class="d-flex justify-content-center justify-content-md-end mt-5">
            {{ $products->withQueryString()->links() }}
        </div>

    </div>
</div>

@endsection