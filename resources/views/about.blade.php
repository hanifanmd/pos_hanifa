@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for About Page (Maroon & Magenta Theme) -->
<style>
    .page-wrapper {
        background-color: #fcf5f7;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .custom-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(155, 34, 70, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .card-header-custom {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        color: white;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #802040;
    }
    .btn-custom {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        color: white;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        opacity: 0.9;
        color: white;
    }
</style>

<div class="page-wrapper">
    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- 1. Tentang Saya (Hanifa) -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-header card-header-custom fw-bold py-3">👤 Tentang Saya</div>
                    <div class="card-body text-center bg-light">
                        <!-- Ganti path gambar sesuai foto Anda di folder public/images/ -->
                        <img src="{{ asset('images/popo.jpg') }}" class="rounded-circle mb-3 shadow profile-avatar" alt="Hanifa">
                        <h5 class="fw-bold text-dark">Hanifa</h5>
                        <p class="text-muted small">Pengembang & Pemilik Toko Bunga</p>
                        <p class="text-secondary small">Saya adalah pengembang aplikasi ini yang berfokus pada kemudahan pengelolaan inventaris dan transaksi digital untuk toko bunga.</p>
                    </div>
                </div>
            </div>

            <!-- 2. Tentang Aplikasi / Toko Bunga -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-header card-header-custom fw-bold py-3">💻 Tentang Toko & Aplikasi</div>
                    <div class="card-body bg-light text-secondary">
                        <p><strong>Toko Bunga</strong> adalah tempat penyedia berbagai macam rangkaian buket bunga segar dan pilihan terbaik untuk setiap momen spesial Anda.</p>
                        <p class="mb-0">Aplikasi sistem kasir (POS) ini dirancang khusus untuk mempermudah pencatatan penjualan buket bunga secara digital, cepat, dan akurat.</p>
                    </div>
                </div>
            </div>

            <!-- 3. Fitur Utama -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-header card-header-custom fw-bold py-3">✨ Fitur Utama</div>
                    <div class="card-body bg-light text-secondary">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">✅ Manajemen Data Produk & Katalog Bunga</li>
                            <li class="mb-2">✅ Pencatatan Transaksi Penjualan Buket</li>
                            <li class="mb-2">✅ Ringkasan Penjualan & Laporan Harian</li>
                            <li>✅ Manajemen Akun Pengguna (Admin/Kasir)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 4. Teknologi yang Digunakan -->
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0 custom-card">
                    <div class="card-header card-header-custom fw-bold py-3">🛠️ Teknologi</div>
                    <div class="card-body bg-light text-secondary">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong>Framework:</strong> Laravel (PHP)</li>
                            <li class="mb-2"><strong>Frontend:</strong> Bootstrap 5 & Blade Templates</li>
                            <li class="mb-2"><strong>Database:</strong> MySQL</li>
                            <li><strong>Server:</strong> Laragon / Apache</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak & Tombol Kembali -->
        <div class="card shadow-sm border-0 p-4 text-center bg-light custom-card">
            <h5 class="fw-bold mb-3" style="color: #802040;">📬 Hubungi Pengembang</h5>
            <p class="mb-3 text-secondary">
                📧 Email: <a href="mailto:hanifa@email.com" class="text-decoration-none fw-bold" style="color: #9b2246;">hanifanurulmaulidia@email.com</a> | 
                📸 Instagram: <a href="https://instagram.com/hanifa_nmd" target="_blank" class="text-decoration-none fw-bold" style="color: #9b2246;">@hanifa_nmd</a>
            </p>
            <div>
                <a href="{{ route('penjualan.index') }}" class="btn btn-custom px-4 py-2 fw-bold shadow-sm">Kembali ke Daftar Penjualan</a>
            </div>
        </div>
    </div>
</div>

@endsection