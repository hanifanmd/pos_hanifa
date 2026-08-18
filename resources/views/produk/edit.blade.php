@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<!-- Custom Magenta Theme Styling for Form -->
<style>
    .page-wrapper {
        background-color: #fff9fb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-form {
        background: #a8204d; /* Disesuaikan ke warna magenta/maroon elegan */
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(168, 32, 77, 0.2);
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(168, 32, 77, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #f2c7d4;
        background-color: #fffdfd;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #a8204d;
        box-shadow: 0 0 0 3px rgba(168, 32, 77, 0.15);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 600;
        color: #4a3b42;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .btn-submit-custom {
        background: #a8204d;
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 10px rgba(168, 32, 77, 0.3);
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        background: #901a40;
        color: white;
        transform: translateY(-1px);
    }
    .btn-back-custom {
        background: #fce8ed;
        border: none;
        color: #a8204d;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        background: #f7d3df;
        color: #901a40;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-form p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm" style="color: #a8204d !important;">
                    📦 Manajemen Persediaan
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Edit Produk</h1>
                <p class="text-white mb-0 opacity-75">Perbarui informasi data produk: <strong>{{ $produk->nama }}</strong></p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('produk.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" style="color: #a8204d;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        @include('produk._form')

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                            <a href="{{ route('produk.index') }}" class="btn btn-back-custom">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit-custom">
                                <i class="bi bi-check-lg me-1"></i> Update Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection