@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

@include('layouts.navbar')

<!-- Custom Modern Theme for About Page -->
<style>
    .page-wrapper {
        background-color: #fcf5f7;
        min-height: 100vh;
        padding: 2.5rem 0 4rem;
    }

    /* Hero Section */
    .about-hero {
        background: linear-gradient(135deg, #802040 0%, #9b2246 50%, #c71585 100%);
        border-radius: 24px;
        color: #ffffff;
        padding: 3.5rem 2rem;
        box-shadow: 0 15px 30px rgba(128, 32, 64, 0.2);
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    /* Card Base Style */
    .custom-card {
        border: 1px solid rgba(155, 34, 70, 0.08);
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 25px rgba(155, 34, 70, 0.05);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    .custom-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(155, 34, 70, 0.12);
    }

    /* Profile Section Styling */
    .profile-card-header {
        background: linear-gradient(135deg, #fce8ee 0%, #fff0f4 100%);
        border-bottom: 1px solid #f9d6e2;
        padding: 2rem 1.5rem 1rem;
    }
    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
    }
    .profile-avatar {
        width: 130px;
        height: 130px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ffffff;
        box-shadow: 0 8px 20px rgba(128, 32, 64, 0.2);
    }
    .badge-dev {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        color: #fff;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        box-shadow: 0 4px 10px rgba(128, 32, 64, 0.25);
    }

    /* Feature Items */
    .feature-box {
        background-color: #fdf6f8;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        border-left: 4px solid #9b2246;
        transition: all 0.2s ease;
    }
    .feature-box:hover {
        background-color: #fce8ee;
        transform: translateX(4px);
    }

    /* Tech Badges */
    .tech-chip {
        display: inline-flex;
        align-items: center;
        background: #fcf0f4;
        color: #802040;
        border: 1px solid #f7d6e0;
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        margin-right: 0.5rem;
        margin-bottom: 0.75rem;
        transition: all 0.2s ease;
    }
    .tech-chip:hover {
        background: #9b2246;
        color: #ffffff;
        border-color: #9b2246;
    }

    /* Contact Links */
    .contact-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .contact-email {
        background-color: #fce8ee;
        color: #802040;
    }
    .contact-email:hover {
        background-color: #9b2246;
        color: #ffffff;
    }
    .contact-ig {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        color: #ffffff;
    }
    .contact-ig:hover {
        opacity: 0.9;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-back-main {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        color: white;
        font-weight: 700;
        border-radius: 50px;
        padding: 0.75rem 2.5rem;
        border: none;
        box-shadow: 0 6px 18px rgba(128, 32, 64, 0.25);
        transition: all 0.3s ease;
    }
    .btn-back-main:hover {
        color: white;
        opacity: 0.95;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(128, 32, 64, 0.35);
    }
</style>

<div class="page-wrapper">
    <div class="container">

        <!-- 1. Hero Banner Header -->
        <div class="about-hero text-center mb-5">
            <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                🌸 Sistem Kasir Toko Bunga
            </span>
            <h1 class="display-5 fw-bold mb-2">Solusi Digital Rangkaian Indah</h1>
            <p class="fs-5 text-white-50 mx-auto mb-0" style="max-width: 650px;">
                Mengintegrasikan keindahan rangkaian bunga segar dengan sistem manajemen transaksi modern yang efisien, akurat, dan mudah digunakan.
            </p>
        </div>

        <div class="row g-4 mb-5">
            <!-- 2. Profil Pengembang -->
            <div class="col-lg-5">
                <div class="card custom-card h-100 text-center overflow-hidden">
                    <div class="profile-card-header">
                        <div class="profile-avatar-wrapper mb-3">
                            <img src="{{ asset('images/popo.jpg') }}" class="profile-avatar" alt="Hanifa">
                        </div>
                        <h4 class="fw-bold mb-1" style="color: #581845;">Hanifa</h4>
                        <span class="badge-dev">Developer & Owner</span>
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-center">
                        <p class="text-secondary mb-0 leading-relaxed">
                            <i class="bi bi-quote fs-3 text-muted d-block mb-1"></i>
                            Berfokus pada pengembangan aplikasi transaksi digital yang responsif untuk membantu efisiensi operasional harian dan pencatatan inventaris toko bunga secara terstruktur.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3. Fitur Utama & Deskripsi Aplikasi -->
            <div class="col-lg-7">
                <div class="card custom-card h-100 p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle p-3 me-3 text-white" style="background: linear-gradient(135deg, #802040 0%, #9b2246 100%);">
                            <i class="bi bi-stars fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0" style="color: #581845;">Tentang Aplikasi & Fitur</h4>
                            <small class="text-muted">Fitur andalan sistem Point of Sales (POS)</small>
                        </div>
                    </div>

                    <p class="text-secondary mb-4">
                        Aplikasi ini dirancang khusus untuk mempermudah pengelolaan stok bunga, pembuatan pesanan buket, serta menyajikan laporan keuangan harian secara cermat.
                    </p>

                    <!-- List Fitur Bergaya Kartu -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-box-seam fs-4 me-3" style="color: #9b2246;"></i>
                                <span class="fw-semibold text-dark">Katalog & Stok Bunga</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-receipt-cutoff fs-4 me-3" style="color: #9b2246;"></i>
                                <span class="fw-semibold text-dark">Pencatatan Penjualan</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-graph-up-arrow fs-4 me-3" style="color: #9b2246;"></i>
                                <span class="fw-semibold text-dark">Laporan & Ringkasan</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-shield-lock fs-4 me-3" style="color: #9b2246;"></i>
                                <span class="fw-semibold text-dark">Manajemen Akses User</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Teknologi Stack -->
        <div class="card custom-card p-4 mb-5">
            <h5 class="fw-bold mb-3 d-flex align-items-center" style="color: #581845;">
                <i class="bi bi-cpu me-2" style="color: #9b2246;"></i> Teknologi yang Digunakan
            </h5>
            <div class="d-flex flex-wrap align-items-center">
                <div class="tech-chip"><i class="bi bi-code-slash me-2"></i> Laravel Framework</div>
                <div class="tech-chip"><i class="bi bi-bootstrap me-2"></i> Bootstrap 5</div>
                <div class="tech-chip"><i class="bi bi-filetype-html me-2"></i> Blade Template Engine</div>
                <div class="tech-chip"><i class="bi bi-database me-2"></i> MySQL Database</div>
                <div class="tech-chip"><i class="bi bi-hdd-network me-2"></i> Apache / Laragon</div>
            </div>
        </div>

        <!-- 5. Footer Kontak & Navigasi -->
        <div class="card custom-card p-4 p-md-5 text-center">
            <h4 class="fw-bold mb-2" style="color: #581845;">Hubungi Pengembang</h4>
            <p class="text-muted mb-4">Punya pertanyaan atau butuh bantuan terkait aplikasi? Silakan hubungi kontak di bawah ini:</p>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <a href="mailto:hanifanurulmaulidia@email.com" class="contact-link contact-email">
                    <i class="bi bi-envelope-fill me-2"></i> hanifanurulmaulidia@email.com
                </a>
                <a href="https://instagram.com/hanifa_nmd" target="_blank" class="contact-link contact-ig">
                    <i class="bi bi-instagram me-2"></i> @hanifa_nmd
                </a>
            </div>

            <div class="pt-3 border-top">
                <a href="{{ route('penjualan.index') }}" class="btn btn-back-main">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Penjualan
                </a>
            </div>
        </div>

    </div>
</div>

@endsection