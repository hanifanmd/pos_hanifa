@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Magenta Theme Styling for Detail -->
<style>
    .page-wrapper {
        background-color: #fff9fb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-detail {
        background: #a8204d; /* Disesuaikan ke warna magenta/maroon elegan */
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(168, 32, 77, 0.2);
    }
    .custom-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(168, 32, 77, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    
    /* Product Image Hover & Cursor FX */
    .img-preview-container {
        position: relative;
        cursor: pointer;
        overflow: hidden;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(168, 32, 77, 0.12);
    }
    .product-detail-img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 16px;
        transition: transform 0.4s ease;
    }
    .img-preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(168, 32, 77, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .img-preview-container:hover .product-detail-img {
        transform: scale(1.05);
    }
    .img-preview-container:hover .img-preview-overlay {
        opacity: 1;
    }

    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #88586c;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #4a3b42;
    }
    .badge-price-buy {
        background-color: #fce8ed;
        color: #901a40;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    .badge-price-sell {
        background-color: #f7d3df;
        color: #a8204d;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    .badge-stock {
        background: #a8204d;
        color: white;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .btn-back-custom {
        background: #a8204d;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2.5rem;
        box-shadow: 0 4px 10px rgba(168, 32, 77, 0.3);
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        background: #901a40;
        color: white;
        transform: translateY(-1px);
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-detail p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm" style="color: #a8204d !important;">
                    🔍 Rincian Produk
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Informasi Produk</h1>
                <p class="text-white mb-0 opacity-75">Melihat detail lengkap data inventaris produk.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" style="color: #a8204d;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Detail Content Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <div class="row align-items-center g-4">
                        
                        <!-- Kolom Foto (Bisa di-klik) -->
                        <div class="col-md-5 text-center">
                            @if($produk->foto)
                                <div class="img-preview-container" data-bs-toggle="modal" data-bs-target="#imageZoomModal">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="product-detail-img" alt="{{ $produk->nama }}">
                                    <div class="img-preview-overlay">
                                        <i class="bi bi-zoom-in fs-4 me-2"></i> Klik untuk Perbesar
                                    </div>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center product-detail-img text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Kolom Informasi -->
                        <div class="col-md-7">
                            <div class="mb-4">
                                <div class="info-label">Nama Produk</div>
                                <div class="fs-3 fw-bold text-dark">{{ $produk->nama }}</div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="info-label">Harga Beli (Dasar)</div>
                                    <div class="mt-1">
                                        <span class="badge-price-buy">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Harga Jual</div>
                                    <div class="mt-1">
                                        <span class="badge-price-sell">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="info-label">Stok Tersedia</div>
                                    <div class="mt-1">
                                        <span class="badge-stock">{{ $produk->stok }} pcs</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="info-label">Diimput Oleh</div>
                                    <div class="info-value mt-1" style="color: #a8204d;">
                                        <i class="bi bi-person-circle me-1"></i> {{ $produk->user->name ?? 'Admin' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi Bawah -->
                            <div class="d-flex justify-content-start gap-2 pt-3 border-top">
                                <a href="{{ route('produk.index') }}" class="btn btn-back-custom">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                                </a>
                                @can('update', $produk)
                                <a href="{{ route('produk.edit', $produk) }}" class="btn text-white fw-semibold rounded-pill px-4" style="background: #e0a800;">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                @endcan
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal Pop-up Zoom Gambar -->
@if($produk->foto)
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark ms-2" id="imageZoomModalLabel" style="color: #a8204d !important;">🌸 {{ $produk->nama }}</h5>
                <button type="button" class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 80vh; object-fit: contain;" alt="{{ $produk->nama }}">
            </div>
        </div>
    </div>
</div>
@endif

@endsection