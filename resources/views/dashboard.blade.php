@extends('layouts.app')

@section('title', 'Ringkasan Hari Ini')

@section('content')

@include('layouts.navbar')

<style>
    .page-wrapper {
        background-color: #fdf2f5;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .dashboard-header {
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        border-radius: 16px;
        color: #fff;
        padding: 2.5rem;
        box-shadow: 0 10px 20px rgba(168, 28, 81, 0.25);
        margin-bottom: 2.5rem;
    }
    .section-title {
        font-weight: 700;
        color: #4a1d2d;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 4px;
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        border-radius: 2px;
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(168, 28, 81, 0.08);
        background: #ffffff;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .custom-card:hover {
        transform: translateY(-5px);
    }
    .card-header-custom {
        background: linear-gradient(135deg, #fce8ef 0%, #f7d1de 100%);
        border-bottom: 1px solid rgba(168, 28, 81, 0.1);
        font-weight: 600;
        color: #6b1f3b;
        padding: 1.2rem;
    }
    .stat-value {
        font-weight: 800;
        font-size: 1.75rem;
        color: #a81c51;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 1rem;
    }
    .badge-stock-low {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .badge-stock-empty {
        background: linear-gradient(135deg, #d90429 0%, #ef233c 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
    .badge-best-seller {
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        color: #fff;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <div class="dashboard-header text-center">
            <h1 class="display-5 fw-bold mb-2">Ringkasan Hari Ini</h1>
            <p class="text-white-50 fs-5 mb-0">
                <i class="bi bi-calendar-check me-2"></i>({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
            </p>
        </div>

        @can('__viewAny', App\Models\User::class)
        <div class="mb-5">
            <h2 class="section-title">Penjualan hari ini</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #a81c51;"><i class="bi bi-wallet2 me-2"></i> Total Nilai Penjualan Hari Ini</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #a81c51;"><i class="bi bi-receipt me-2"></i> Jumlah penjualan Hari Ini</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">{{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h2 class="section-title">Tunai dan status pembayaran</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #a81c51;"><i class="bi bi-cash-stack me-2"></i> Total Pembayaran Tunai</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card custom-card text-center h-100">
                        <div class="card-header card-header-custom">
                            <h5 class="mb-0 fw-bold" style="color: #a81c51;"><i class="bi bi-credit-card-2-front me-2"></i> Total Pembayaran Non-Tunai</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center py-4">
                            <div class="stat-value">Rp. {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <div class="mb-5">
            <h2 class="section-title">Status persediaan kritis</h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0 fw-bold" style="color: #d90429;"><i class="bi bi-exclamation-triangle me-2"></i> Daftar Produk Stok Rendah</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" class="text-center">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge-stock-low">{{ $produk->stok }} pcs</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $produkStokRendah->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card custom-card h-100">
                        <div class="card-header card-header-custom">
                            <h4 class="mb-0 fw-bold" style="color: #d90429;"><i class="bi bi-x-circle me-2"></i> Produk Habis Stok</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" class="text-center">Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-4 fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge-stock-empty">{{ $produk->stok }} pcs</span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $produkStokHabis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="section-title">Barang paling laris</h2>
            <div class="card custom-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="ps-4">Nama Produk</th>
                                    <th scope="col">Stok Tersisa</th>
                                    <th scope="col" class="text-center">Unit Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $produk->nama }}</td>
                                    <td>{{ $produk->stok }} pcs</td>
                                    <td class="text-center">
                                        <span class="badge-best-seller">{{ $produk->total_terjual }} terjual</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        Belum ada data penjualan produk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection