@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<!-- Custom Colorful Styling for Penjualan (Exact Maroon Theme) -->
<style>
    .page-wrapper {
        background-color: #fcf5f7;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-sale {
        background: linear-gradient(135deg, #802040 0%, #9b2246 100%);
        border-radius: 16px;
        color: #ffffff;
        box-shadow: 0 10px 20px rgba(128, 32, 64, 0.25);
    }
    .hero-banner-sale .text-muted-custom {
        color: #f7d6e0 !important;
    }
    .custom-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 5px 15px rgba(155, 34, 70, 0.08);
        background: #ffffff;
        overflow: hidden;
    }
    .search-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(155, 34, 70, 0.05);
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
    .badge-total-bayar {
        background-color: #fce8ee;
        color: #9b2246;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .badge-method {
        background: linear-gradient(135deg, #9b2246 0%, #b5179e 100%);
        color: white;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        box-shadow: 0 2px 6px rgba(155, 34, 70, 0.3);
    }
    .badge-status {
        background: linear-gradient(135deg, #802040 0%, #c71585 100%);
        color: white;
        padding: 5px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        box-shadow: 0 2px 6px rgba(128, 32, 64, 0.3);
    }
    .btn-create-sale {
        background: #ffffff;
        color: #9b2246;
        font-weight: bold;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-create-sale:hover {
        background: #4a1024;
        color: #ffffff;
    }

    /* --- BASE ACTION BUTTON STYLE --- */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        font-size: 0.875rem;
        line-height: 1.5;
        text-decoration: none !important;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
    }

    /* Varian Warna Tombol */
    .btn-detail-custom {
        background: linear-gradient(135deg, #9b2246 0%, #c71585 100%);
        color: #ffffff !important;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #b5179e 0%, #7209b7 100%);
        color: #ffffff !important;
    }

    .btn-delete-custom {
        background: linear-gradient(135deg, #802040 0%, #581845 100%);
        color: #ffffff !important;
    }

    /* Hover effect seragam */
    .btn-action:hover {
        opacity: 0.9;
        color: #ffffff !important;
        transform: translateY(-1px);
    }
</style>

<div class="page-wrapper">
    <div class="container">

        @if(session('errors'))
            <div class="alert alert-danger shadow-sm rounded-4 border-0 mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
            </div>
        @endif
        
        <!-- Hero Banner Exact Maroon Theme -->
        <div class="hero-banner-sale p-4 p-md-5 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white text-dark px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm">
                    🌸 Laporan Transaksi
                </span>
                <h1 class="display-6 fw-bold mb-1">Halaman Penjualan</h1>
                <p class="text-muted-custom mb-0 fw-semibold">Kelola dan pantau seluruh transaksi penjualan harian dengan mudah.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.create') }}" class="btn btn-create-sale btn-lg shadow-sm px-4">
                    + Tambah Penjualan
                </a>
            </div>
        </div>

        <!-- Search Bar Card -->
        <div class="card custom-card p-3 mb-4 search-box">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0 text-dark ps-3">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request()->search }}"
                        class="form-control border-0 bg-white py-2 px-2"
                        placeholder="Search penjualan..."
                    >
                    <button class="btn px-4 fw-semibold text-white" type="submit" style="background: linear-gradient(135deg, #802040 0%, #9b2246 100%); border: none;">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary px-3">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card Maroon -->
        <div class="card custom-card">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="ps-4 py-3">#</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3">Metode Pembayaran</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 text-center">Aksi</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                        <tr>
                            <th scope="row" class="ps-4 fw-bold text-muted">{{ $sales->firstItem() + $loop->index }}</th>
                            <td>
                                <span class="fw-semibold text-dark"><i class="bi bi-calendar-event me-1" style="color: #9b2246;"></i> {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark"><i class="bi bi-person-badge me-1" style="color: #802040;"></i> {{ $sale->user->name }}</span>
                            </td>
                            <td>
                                <span class="badge-total-bayar">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <span class="badge-method">{{ $sale->metode_pembayaran }}</span>
                            </td>
                            <td>
                                <span class="badge-status">{{ $sale->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 align-items-center justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-detail-custom btn-sm px-3">Detail</a>
                                    
                                    <!-- Tombol Edit & Hapus -->
                                    @if(strtolower($sale->status) !== 'completed')
                                        @can('view', $sale)
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn-action btn-edit btn-sm px-3">
                                            Edit
                                        </a>
                                        @endcan                                    
                                        
                                        @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete-custom btn-sm px-3" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                        @endcan
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted fs-5"><i class="bi bi-inbox fs-1 d-block mb-2" style="color: #9b2246;"></i> Data Tidak Ditemukan</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="card-footer bg-white border-0 py-4 px-4">
                <div class="d-flex justify-content-center justify-content-md-end">
                    {{ $sales->withQueryString()->links() }}
                </div>
            </div>
        </div>

    </div>
</div>

@endsection