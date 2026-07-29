@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Sales Detail (Pink Theme) -->
<style>
    .page-wrapper {
        background-color: #fff5f7;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-sales {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(255, 117, 140, 0.25);
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(235, 107, 133, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
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
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(235, 107, 133, 0.15);
    }
    .badge-total {
        background-color: #fce4ec;
        color: #c2185b;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
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
        font-size: 1.05rem;
        font-weight: 700;
        color: #59404c;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner -->
        <div class="hero-banner-sales p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-dark px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🧾 Transaksi POS
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Rincian Penjualan</h1>
                <p class="text-white mb-0 opacity-75">Informasi lengkap transaksi dan daftar item produk yang dibeli.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Informasi Utama Transaksi (Card Ringkasan) -->
        <div class="card custom-card p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="info-label">Kasir / Petugas</div>
                    <div class="info-value" style="color: #ff758c;">
                        <i class="bi bi-person-circle me-1"></i> {{ $sale->user->name ?? 'Kasir' }}
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="info-label">Tanggal Transaksi</div>
                    <div class="info-value">
                        <i class="bi bi-calendar-event me-1 text-muted"></i> {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="info-label">Total Pembayaran</div>
                    <div class="mt-1">
                        <span class="badge-total">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Item Produk yang Dibeli -->
        <div class="card custom-card">
            <div class="card-header bg-white border-0 py-3 px-4 fw-bold fs-5" style="color: #59404c;">
                <i class="bi bi-cart-check me-2" style="color: #ff758c;"></i> Item Produk Terjual
            </div>
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">Foto</th>
                            <th scope="col" class="py-3">Nama Produk</th>
                            <th scope="col" class="py-3 text-end pe-4">Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->itemPenjualan as $index => $item)
                        <tr>
                            <th scope="row" class="ps-4 fw-bold text-muted">{{ $index + 1 }}</th>
                            <td>
                                @if($item->produk && $item->produk->foto)
                                    <img src="{{ asset('storage/' . $item->produk->foto) }}" class="product-img" alt="{{ $item->produk->nama }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center product-img text-muted">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $item->produk->nama ?? 'Produk Dihapus' }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <span class="fw-semibold" style="color: #c2185b;">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted fs-5">Tidak ada item produk dalam transaksi ini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Card Footer dengan Tombol Kembali -->
            <div class="card-footer bg-white border-0 py-4 px-4 text-end">
                <a href="{{ route('penjualan.index') }}" class="btn rounded-pill px-4 fw-semibold text-white" style="background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);">
                    Kembali ke Daftar Penjualan
                </a>
            </div>
        </div>

    </div>
</div>

@endsection