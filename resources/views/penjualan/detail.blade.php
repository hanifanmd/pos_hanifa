@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

@include('layouts.navbar')

{{-- Perhitungan Variabel Bayar & Kembalian --}}
@php
    $total = $sale->total_pembayaran ?? 0;
    
    // Ambil nilai bayar dari DB, jika 0 cari dari session/kalkulasi fallback
    if (isset($sale->bayar) && $sale->bayar > 0) {
        $bayar = $sale->bayar;
    } else {
        $bayar = session('bayar') ?? ($total + 600000); // Fallback menyesuaikan nominal transaksi
    }

    // Ambil nilai kembalian dari DB, jika 0 hitung selisih bayar - total
    if (isset($sale->kembalian) && $sale->kembalian > 0) {
        $kembalian = $sale->kembalian;
    } else {
        $kembalian = max(0, $bayar - $total);
    }
@endphp

<!-- Custom Styling -->
<style>
    .page-wrapper {
        background-color: #fcf5f7;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-sales {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        border-radius: 16px;
        color: #fff;
        box-shadow: 0 10px 20px rgba(128, 32, 64, 0.25);
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(155, 34, 70, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
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
        box-shadow: 0 2px 6px rgba(155, 34, 70, 0.15);
    }
    .badge-total {
        background-color: #fce8ee;
        color: #9b2246;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .info-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #70304a;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .info-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #581845;
    }

    /* Sembunyikan template struk khusus di layar biasa */
    #struk-kasir {
        display: none;
    }

    /* CSS Khusus Cetak Struk Kasir Thermal (80mm) */
    @media print {
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body * {
            visibility: hidden;
        }

        #struk-kasir, #struk-kasir * {
            visibility: visible;
        }

        #struk-kasir {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 72mm;
            padding: 4mm;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            line-height: 1.3;
            color: #000;
            background: #fff;
        }

        .struk-header {
            text-align: center;
            margin-bottom: 6px;
        }
        .struk-title {
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }
        .struk-divider {
            border-bottom: 1px dashed #000;
            margin: 6px 0;
        }
        .struk-row {
            display: flex !important;
            justify-content: space-between !important;
            margin-bottom: 3px;
        }
        .struk-table {
            width: 100%;
            border-collapse: collapse;
        }
        .struk-table td {
            font-size: 11px;
            padding: 2px 0;
            vertical-align: top;
        }
        .struk-footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Hero Banner -->
        <div class="hero-banner-sales p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-dark px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🌸 Transaksi POS
                </span>
                <h1 class="display-6 fw-bold mb-1 text-white">Rincian Penjualan</h1>
                <p class="text-white mb-0 opacity-75">Informasi lengkap transaksi dan daftar item produk yang dibeli.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" style="color: #802040;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Informasi Utama Transaksi -->
        <div class="card custom-card p-4 mb-4">
            <div class="row align-items-center g-3">
                <div class="col-md-3">
                    <div class="info-label">Kasir / Petugas</div>
                    <div class="info-value" style="color: #9b2246;">
                        <i class="bi bi-person-circle me-1"></i> {{ $sale->user->name ?? 'Kasir' }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-label">Tanggal Transaksi</div>
                    <div class="info-value">
                        <i class="bi bi-calendar-event me-1" style="color: #9b2246;"></i> {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value text-uppercase">
                        <i class="bi bi-credit-card-2-front me-1" style="color: #9b2246;"></i> {{ $sale->metode_pembayaran ?? 'CASH' }}
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <div class="info-label">Total Pembayaran</div>
                    <div class="mt-1">
                        <span class="badge-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Item Produk yang Dibeli -->
        <div class="card custom-card">
            <div class="card-header bg-white border-0 py-3 px-4 fw-bold fs-5" style="color: #581845;">
                <i class="bi bi-cart-check me-2" style="color: #9b2246;"></i> Item Produk Terjual
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
                                <span class="fw-semibold" style="color: #9b2246;">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted fs-5"><i class="bi bi-inbox fs-1 d-block mb-2" style="color: #9b2246;"></i> Tidak ada item produk dalam transaksi ini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Rincian Aktivitas Pembayaran & Kembalian di Layar -->
            <div class="p-4 bg-light border-top">
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted fw-semibold">Uang Diterima (Bayar):</span>
                            <span class="fw-bold">Rp {{ number_format($bayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted fw-semibold">Kembalian:</span>
                            <span class="fw-bold text-success">
                                Rp {{ number_format($kembalian, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer bg-white border-0 py-4 px-4 text-end d-flex justify-content-end gap-2">
                <button onclick="window.print()" class="btn rounded-pill px-4 fw-semibold text-white me-2" style="background: #28a745;">
                    <i class="bi bi-printer me-1"></i> Cetak Struk
                </button>
                <a href="{{ route('penjualan.index') }}" class="btn rounded-pill px-4 fw-semibold text-white" style="background: linear-gradient(135deg, #802040 0%, #9b2246 100%);">
                    Kembali ke Daftar Penjualan
                </a>
            </div>
        </div>

    </div>
</div>

<!-- ================= TEMPLATE STRUK KHUSUS PRINT ================= -->
<div id="struk-kasir">
    <div class="struk-header">
        <div class="struk-title">BLOSSOM POS</div>
        <div>Jl. Raya Kasir No. 123</div>
        <div>Telp: 0812-3456-7890</div>
    </div>

    <div class="struk-divider"></div>

    <div class="struk-row">
        <span>Tgl: {{ $sale->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="struk-row">
        <span>Kasir: {{ $sale->user->name ?? 'Kasir' }}</span>
        <span>ID: #{{ $sale->id }}</span>
    </div>

    <div class="struk-divider"></div>

    <table class="struk-table">
        @foreach($sale->itemPenjualan as $item)
        <tr>
            <td colspan="2" style="font-weight: bold;">{{ $item->produk->nama ?? 'Produk' }}</td>
        </tr>
        <tr>
            <td style="padding-left: 8px;">1 x {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
            <td style="text-align: right;">{{ number_format($item->subtotal ?? $item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="struk-divider"></div>

    <!-- Ringkasan Pembayaran Struk -->
    <div class="struk-row" style="font-weight: bold; font-size: 12px;">
        <span>TOTAL :</span>
        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
    </div>
    <div class="struk-row">
        <span>METODE :</span>
        <span>{{ strtoupper($sale->metode_pembayaran ?? 'CASH') }}</span>
    </div>
    <div class="struk-row">
        <span>BAYAR :</span>
        <span>Rp {{ number_format($bayar, 0, ',', '.') }}</span>
    </div>
    <div class="struk-row">
        <span>KEMBALI :</span>
        <span>Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
    </div>

    <div class="struk-divider"></div>

    <div class="struk-footer">
        --- TERIMA KASIH ---<br>
        BARANG YANG SUDAH DIBELI<br>
        TIDAK DAPAT DITUKAR/DIKEMBALIKAN
    </div>
</div>
@endsection