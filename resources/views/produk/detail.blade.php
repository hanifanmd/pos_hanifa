@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Detail (Pink Theme) -->
<style>
    .page-wrapper {
        background-color: #fff5f7;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-detail {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(255, 117, 140, 0.25);
    }
    .custom-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(235, 107, 133, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .product-detail-img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(235, 107, 133, 0.12);
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
        color: #59404c;
    }
    .badge-price-buy {
        background-color: #ffe6eb;
        color: #d6336c;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    .badge-price-sell {
        background-color: #fce4ec;
        color: #c2185b;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    .badge-stock {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .btn-back-custom {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2.5rem;
        box-shadow: 0 4px 10px rgba(255, 117, 140, 0.3);
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        opacity: 0.9;
        color: white;
        transform: translateY(-1px);
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-detail p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-dark px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🔍 Rincian Produk
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Informasi Produk</h1>
                <p class="text-white mb-0 opacity-75">Melihat detail lengkap data inventaris produk.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Detail Content Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <div class="row align-items-center g-4">
                        
                        <!-- Kolom Foto -->
                        <div class="col-md-5 text-center">
                            @if($produk->foto)
                                <img src="{{ asset('storage/' . $produk->foto) }}" class="product-detail-img" alt="{{ $produk->nama }}">
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
                                    <div class="info-value mt-1" style="color: #ff758c;">
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
                                <a href="{{ route('produk.edit', $produk) }}" class="btn text-white fw-semibold rounded-pill px-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
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

@endsection