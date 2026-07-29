@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

@include('layouts.navbar')

<!-- Custom Flower Shop Pink Styling for Form -->
<style>
    .page-wrapper {
        background-color: #fffafb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-form {
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
    .form-control, .form-select {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #f3d1d7;
        background-color: #fffdfd;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ff758c;
        box-shadow: 0 0 0 3px rgba(255, 117, 140, 0.15);
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 600;
        color: #4a3b42;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .btn-submit-custom {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        box-shadow: 0 4px 10px rgba(255, 117, 140, 0.3);
        transition: all 0.3s ease;
    }
    .btn-submit-custom:hover {
        opacity: 0.9;
        color: white;
        transform: translateY(-1px);
    }
    .btn-back-custom {
        background: #fce4ec;
        border: none;
        color: #6b4c58;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        transition: all 0.3s ease;
    }
    .btn-back-custom:hover {
        background: #f8bbd0;
        color: #4a3b42;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner / Header -->
        <div class="hero-banner-form p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-danger px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🌸 Manajemen Akun Toko Bunga
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Edit Akun</h1>
                <p class="text-white mb-0 opacity-75">Perbarui informasi data user: <strong>{{ $user->name }}</strong></p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('admin.users') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm text-danger">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card custom-card p-4 p-md-5">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Tambahkan method PUT jika belum ada di template form utama -->
                        
                        @include('users._form')

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top">
                            <a href="{{ route('admin.users') }}" class="btn btn-back-custom">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-submit-custom">
                                <i class="bi bi-check-lg me-1"></i> Perbarui Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection