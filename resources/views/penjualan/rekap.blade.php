@extends('layouts.app')

@section('title', 'Rekap Penjualan')

@php
    $harianChart = $harian->map(function ($item) {
        return [
            'label' => \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M'),
            'value' => (float) $item->total_penjualan,
        ];
    })->values();

    $bulananChart = $bulanan->map(function ($item) {
        return [
            'label' => \Carbon\Carbon::createFromFormat('Y-m', $item->bulan)->translatedFormat('M Y'),
            'value' => (float) $item->total_penjualan,
        ];
    })->values();
@endphp

@section('content')

@include('layouts.navbar')

<style>
    .page-wrapper {
        background: linear-gradient(180deg, #fff5f8 0%, #fff 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    .header-card {
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        border-radius: 20px;
        color: white;
        box-shadow: 0 10px 25px rgba(168, 28, 81, 0.2);
    }
    .stat-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(168, 28, 81, 0.08);
        background: white;
    }
    .stat-label {
        color: #7d2f4d;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-weight: 700;
    }
    .stat-value {
        font-size: 1.7rem;
        font-weight: 800;
        color: #a81c51;
    }
    .table-custom thead {
        background: linear-gradient(135deg, #a81c51 0%, #c4295d 100%);
        color: white;
    }
    .table-custom thead th {
        border: none;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.9rem 1rem;
    }
    .section-title {
        color: #4a1d2d;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .print-area, .print-area * {
            visibility: visible;
        }

        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
            background: white;
        }

        .no-print {
            display: none !important;
        }

        .header-card {
            box-shadow: none;
            border-radius: 0;
        }

        .stat-card {
            box-shadow: none;
            border: 1px solid #e5e7eb;
        }
    }
</style>

<div class="page-wrapper print-area">
    <div class="container">
        <div class="header-card p-4 p-md-5 mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold mb-2">
                        <i class="bi bi-bar-chart-line me-1"></i> Dashboard Penjualan
                    </span>
                    <h1 class="mb-0 fw-bold mt-2">Rekap Penjualan</h1>
                </div>
                <div class="d-flex gap-2 no-print">
                    <button onclick="window.print()" class="btn btn-light rounded-pill px-4 fw-bold" style="color: #a81c51;">
                        <i class="bi bi-printer me-1"></i> Print
                    </button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-light rounded-pill px-4 fw-bold" style="color: #a81c51;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card h-100 p-3">
                    <div class="stat-label">Hari Ini</div>
                    <div class="stat-value">Rp {{ number_format($totalHariIni, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100 p-3">
                    <div class="stat-label">Bulan Ini</div>
                    <div class="stat-value">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100 p-3">
                    <div class="stat-label">Tahun Ini</div>
                    <div class="stat-value">Rp {{ number_format($totalTahunIni, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        

        <div class="mb-5">
            <h3 class="section-title">Rekap Harian</h3>
            <div class="card stat-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th class="text-center">Transaksi</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($harian as $data)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center fw-semibold">{{ $data->jumlah_transaksi }}</td>
                                    <td class="text-end pe-4 fw-bold" style="color: #a81c51;">
                                        Rp {{ number_format($data->total_penjualan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data penjualan harian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h3 class="section-title">Rekap Bulanan</h3>
            <div class="card stat-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Bulan</th>
                                <th class="text-center">Transaksi</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bulanan as $data)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m', $data->bulan)->translatedFormat('F Y') }}</td>
                                    <td class="text-center fw-semibold">{{ $data->jumlah_transaksi }}</td>
                                    <td class="text-end pe-4 fw-bold" style="color: #a81c51;">
                                        Rp {{ number_format($data->total_penjualan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data penjualan bulanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3 class="section-title">Rekap Tahunan</h3>
            <div class="card stat-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Tahun</th>
                                <th class="text-center">Transaksi</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tahunan as $data)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $data->tahun }}</td>
                                    <td class="text-center fw-semibold">{{ $data->jumlah_transaksi }}</td>
                                    <td class="text-end pe-4 fw-bold" style="color: #a81c51;">
                                        Rp {{ number_format($data->total_penjualan, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data penjualan tahunan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
