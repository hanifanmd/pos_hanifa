@extends('layouts.app')

@section('title', 'POS Kasir')

@section('content')

@include('layouts.navbar')

<!-- Custom Styling Murni CSS (Magenta/Maroon Theme) -->
<style>
    .page-wrapper {
        background-color: #fff9fb;
        min-height: 100vh;
        padding: 2rem 0;
    }
    .hero-banner-pos {
        background: #a8204d;
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
    .product-item-card {
        border: 1px solid #f2c7d4;
        border-radius: 12px;
        transition: all 0.2s ease;
        background: #ffffff;
    }
    .product-item-card:hover {
        border-color: #a8204d;
        box-shadow: 0 4px 12px rgba(168, 32, 77, 0.15);
    }
    .product-img {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .table-cart thead {
        background: #fce8ed;
        color: #901a40;
    }
    .table-cart thead th {
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .total-display {
        font-size: 1.5rem;
        font-weight: 800;
        color: #a8204d;
    }
    .btn-checkout {
        background: #a8204d;
        border: none;
        color: white;
        font-weight: 600;
        border-radius: 50px;
        padding: 0.7rem 1.5rem;
        box-shadow: 0 4px 10px rgba(168, 32, 77, 0.3);
    }
    .btn-checkout:hover {
        background: #901a40;
        color: white;
    }
    .search-input {
        border-radius: 50px;
        padding: 0.75rem 1.25rem;
        border: 1px solid #f2c7d4;
        background-color: #fffdfd;
    }
    .search-input:focus {
        border-color: #a8204d;
        box-shadow: 0 0 0 3px rgba(168, 32, 77, 0.15);
        background-color: #ffffff;
    }
</style>

<div class="page-wrapper">
    <div class="container">
        
        <!-- Notifikasi Error dari Controller PHP -->
        @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show rounded-12 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-12 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Hero Banner -->
        <div class="hero-banner-pos p-4 mb-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="badge bg-white px-3 py-1 rounded-pill fw-bold mb-2 shadow-sm" style="color: #a8204d !important;">
                    ⚡ Kasir Point of Sale
                </span>
                <h1 class="h3 fw-bold mb-1 text-white">Transaksi Penjualan Baru</h1>
                <p class="text-white mb-0 opacity-75 small">Scan barcode atau pilih produk di sebelah kiri dan kelola keranjang di sebelah kanan.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('penjualan.index') }}" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" style="color: #a8204d;">
                    <i class="bi bi-clock-history me-1"></i> Riwayat Penjualan
                </a>
            </div>
        </div>

        <div class="row g-4">
            
            {{-- ====================== KOLOM 1: BARCODE & PRODUK ============================ --}}
            <div class="col-md-6">
                <div class="card custom-card h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                            <label class="fw-bold small mb-1" style="color: #a8204d;">
                                <i class="bi bi-qr-code-scan me-1"></i> Scan Barcode / Cari Produk
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}" 
                                       class="form-control search-input" 
                                       placeholder="Arahkan Scanner atau ketik nama..." 
                                       autofocus>
                                <button type="submit" class="btn text-white rounded-pill ms-2 px-3" style="background: #a8204d;">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <h5 class="fw-bold text-dark mb-3"><i class="bi bi-grid-fill me-2" style="color: #a8204d;"></i> Katalog Produk</h5>
                    </div>

                    <div class="card-body px-4 py-3" style="max-height: 55vh; overflow-y: auto;">
                        <div class="d-flex flex-column gap-2">
                            @forelse($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="product-item-card p-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="row align-items-center g-2">
                                    <div class="col-7">
                                        <div class="d-flex align-items-center gap-2">
                                            @if($product->foto)
                                                <img src="{{ asset('storage/' . $product->foto) }}" class="product-img" alt="Foto">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center product-img text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold text-dark small">{{ $product->nama }}</div>
                                                <div class="small fw-semibold" style="color: #a8204d;">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <input type="number" name="quantity" value="1" min="1"
                                               class="form-control form-control-sm text-center">
                                    </div>

                                    <div class="col-2">
                                        <button type="submit" class="btn btn-sm w-100 fw-bold text-white" style="background: #a8204d; border: none;" title="Tambah ke Keranjang">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-box-seam fs-1 d-mb-2" style="color: #a8204d;"></i>
                                <p class="mb-0">Produk tidak ditemukan.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====================== KOLOM 2: KERANJANG & CHECKOUT =========================== --}}
            <div class="col-md-6">
                <div class="card custom-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-cart3 me-2" style="color: #a8204d;"></i> Keranjang Belanja</h5>
                        </div>

                        <div class="card-body px-0 py-3">
                            <div class="table-responsive" style="max-height: 35vh; overflow-y: auto;">
                                <table class="table table-cart align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Produk</th>
                                            <th>Harga</th>
                                            <th style="width: 90px;">Qty</th>
                                            <th>Subtotal</th>
                                            <th class="text-end pe-4">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($sale->itemPenjualan as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-semibold text-dark small">{{ $item->produk->nama ?? '-' }}</span>
                                            </td>
                                            <td class="small text-muted">Rp {{ number_format($item->produk->harga_jual ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                                    @csrf 
                                                    @method('PUT')
                                                    <input type="number" name="quantity"
                                                           value="{{ $item->kuantitas }}" min="1"
                                                           class="form-control form-control-sm text-center"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td class="fw-semibold small" style="color: #a8204d;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                            <td class="text-end pe-4">
                                                @can('delete', $item)
                                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" class="d-inline">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm border-0" style="color: #a8204d;" title="Hapus Item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="bi bi-cart-x fs-2 d-block mb-2 opacity-50" style="color: #a8204d;"></i>
                                                Keranjang belanja masih kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Footer / Checkout -->
                    <div class="card-footer bg-light border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted fw-semibold">Subtotal Produk:</span>
                            <span id="subtotal-produk">Rp {{ number_format($sale->itemPenjualan->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted fw-semibold">Biaya Kartu Ucapan:</span>
                            <span id="biaya-kartu-ucapan">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted fw-semibold">Total Pembayaran:</span>
                            <span class="total-display" id="total-pembayaran-form">Rp {{ number_format($sale->itemPenjualan->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>

                        <!-- Form Checkout -->
                        <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return validateCheckout()">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Metode Pembayaran</label>
                                    <select name="payment_method" id="payment_method" class="form-select rounded-pill px-3" required onchange="toggleCashInput()">
                                        <option value="CASH" selected>Cash (Tunai)</option>
                                        <option value="QRIS">QRIS / Non-Tunai</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Uang Diterima (Rp)</label>
                                    <input type="number" 
                                           name="bayar" 
                                           id="bayar"
                                           min="0"
                                           step="1"
                                           class="form-control rounded-pill px-3" 
                                           placeholder="Nominal Uang" 
                                           required
                                           oninput="hitungKembalian()">
                                </div>
                            </div>

                            <div id="qrisBox" class="d-none mb-3">
                                <div class="border rounded-4 p-3 bg-white text-center shadow-sm">
                                    <div class="small fw-semibold text-muted mb-2">Pembayaran QRIS</div>
                                    <img id="qrisImage" src="" alt="QRIS pembayaran" class="img-fluid mx-auto d-block" style="max-width: 220px; border-radius: 12px;">
                                    <div id="qrisTotal" class="mt-3 fw-bold" style="color: #9b2246;">Total: Rp 0</div>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="ada_kartu_ucapan" name="ada_kartu_ucapan" value="1" onchange="toggleGreetingCard()">
                                        <label class="form-check-label fw-semibold" for="ada_kartu_ucapan">Tambah kartu ucapan</label>
                                    </div>
                                </div>
                                <div class="col-12 d-none" id="kartuUcapanWrapper">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Pengirim</label>
                                            <input type="text" name="pengirim" id="pengirim" class="form-control rounded-pill px-3" maxlength="100" placeholder="Nama pengirim">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-semibold">Penerima</label>
                                            <input type="text" name="penerima" id="penerima" class="form-control rounded-pill px-3" maxlength="100" placeholder="Nama penerima">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-semibold">Jenis bunga</label>
                                            <select name="bunga" id="bunga" class="form-select rounded-pill px-3">
                                                <option value="">Pilih bunga</option>
                                                <option value="Mawar">Mawar</option>
                                                <option value="Melati">Melati</option>
                                                <option value="Tulip">Tulip</option>
                                                <option value="Lily">Lily</option>
                                                <option value="Campuran">Campuran</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-semibold">Jumlah tangkai</label>
                                            <input type="number" name="jumlah_tangkai" id="jumlah_tangkai" min="1" max="100" class="form-control rounded-pill px-3" placeholder="Contoh: 12" oninput="updateFlowerPricing()">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-semibold">Harga / tangkai</label>
                                            <input type="number" name="harga_per_tangkai" id="harga_per_tangkai" min="0" step="1000" class="form-control rounded-pill px-3" placeholder="Rp 10000" oninput="updateFlowerPricing()">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-semibold">Hiasan</label>
                                            <input type="text" name="hiasan" id="hiasan" class="form-control rounded-pill px-3" maxlength="150" placeholder="Contoh: Ribbon merah muda">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-semibold">Estimasi biaya</label>
                                            <div class="form-control rounded-pill px-3 bg-light text-dark fw-semibold" id="estimasiBiayaBunga">Rp 0</div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label small fw-semibold">Pesan kartu ucapan</label>
                                            <textarea name="kartu_ucapan" id="kartu_ucapan" rows="3" class="form-control rounded-3 px-3" maxlength="255" placeholder="Contoh: Selamat ulang tahun, semoga bahagia!" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Baris Kembalian Otomatis -->
                            <div class="d-flex justify-content-between align-items-center mb-3 p-2 px-3 bg-white rounded-3 border">
                                <span class="text-muted fw-semibold small">Kembalian:</span>
                                <span class="fw-bold fs-6 text-muted" id="text-kembalian">Rp 0</span>
                            </div>

                            <button type="submit" class="btn btn-checkout w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <i class="bi bi-check-circle-fill me-1"></i> Selesaikan Checkout
                            </button>
                        </form>

                        <!-- Tombol Batal Transaksi -->
                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 rounded-pill py-2 small fw-semibold" style="border: 1px solid #a8204d; color: #a8204d;">
                                <i class="bi bi-x-circle me-1"></i> Batalkan Transaksi
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script Hitung Otomatis Real-time -->
<script>
    const totalPembayaran = parseFloat("{{ $sale->itemPenjualan->sum('subtotal') }}") || 0;

    function getFlowerCost() {
        const jumlahTangkai = parseInt(document.getElementById('jumlah_tangkai')?.value || 0, 10);
        const hargaPerTangkai = parseFloat(document.getElementById('harga_per_tangkai')?.value || 0);
        return jumlahTangkai > 0 ? jumlahTangkai * hargaPerTangkai : 0;
    }

    function getTotalCheckout() {
        return totalPembayaran + (document.getElementById('ada_kartu_ucapan')?.checked ? getFlowerCost() : 0);
    }

    function updateCheckoutSummary() {
        const subtotal = totalPembayaran;
        const biayaKartu = document.getElementById('ada_kartu_ucapan')?.checked ? getFlowerCost() : 0;
        const total = subtotal + biayaKartu;

        document.getElementById('subtotal-produk').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
        document.getElementById('biaya-kartu-ucapan').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(biayaKartu);
        document.getElementById('total-pembayaran-form').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        updateQrisDisplay();
    }

    function updateQrisDisplay() {
        const method = document.getElementById('payment_method')?.value || 'CASH';
        const qrisBox = document.getElementById('qrisBox');
        const qrisImage = document.getElementById('qrisImage');
        const qrisTotal = document.getElementById('qrisTotal');
        const total = getTotalCheckout();

        if (method === 'QRIS') {
            const totalRounded = Math.max(0, Math.round(total));
            const payload = `QRIS-${totalRounded}-HANIFA-FLORIST`;
            qrisImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=${encodeURIComponent(payload)}`;
            qrisTotal.textContent = 'Total: Rp ' + new Intl.NumberFormat('id-ID').format(totalRounded);
            qrisBox.classList.remove('d-none');
        } else {
            qrisBox.classList.add('d-none');
        }
    }

    function hitungKembalian() {
        const bayarInput = parseFloat(document.getElementById('bayar').value) || 0;
        const totalCheckout = getTotalCheckout();
        const kembalian = bayarInput - totalCheckout;
        const display = document.getElementById('text-kembalian');

        if (bayarInput === 0) {
            display.className = "fw-bold fs-6 text-muted";
            display.innerText = "Rp 0";
        } else if (kembalian < 0) {
            display.className = "fw-bold fs-6 text-danger";
            display.innerText = "Kurang Rp " + new Intl.NumberFormat('id-ID').format(Math.abs(kembalian));
        } else {
            display.className = "fw-bold fs-6 text-success";
            display.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(kembalian);
        }
    }

    function toggleCashInput() {
        const method = document.getElementById('payment_method').value;
        const bayarInput = document.getElementById('bayar');
        const totalCheckout = getTotalCheckout();

        if (method === 'QRIS') {
            bayarInput.value = totalCheckout;
            bayarInput.readOnly = true;
        } else {
            bayarInput.readOnly = false;
            bayarInput.value = '';
        }
        updateQrisDisplay();
        hitungKembalian();
    }

    function updateFlowerPricing() {
        const jumlahTangkai = parseInt(document.getElementById('jumlah_tangkai').value || 0, 10);
        const hargaPerTangkai = parseFloat(document.getElementById('harga_per_tangkai').value || 0);
        const estimasi = document.getElementById('estimasiBiayaBunga');
        const total = jumlahTangkai * hargaPerTangkai;

        estimasi.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        updateCheckoutSummary();
        hitungKembalian();
    }

    function toggleGreetingCard() {
        const checkbox = document.getElementById('ada_kartu_ucapan');
        const wrapper = document.getElementById('kartuUcapanWrapper');
        const pengirim = document.getElementById('pengirim');
        const penerima = document.getElementById('penerima');
        const bunga = document.getElementById('bunga');
        const jumlahTangkai = document.getElementById('jumlah_tangkai');
        const hargaPerTangkai = document.getElementById('harga_per_tangkai');
        const hiasan = document.getElementById('hiasan');
        const textarea = document.getElementById('kartu_ucapan');

        if (checkbox.checked) {
            wrapper.classList.remove('d-none');
            pengirim.required = true;
            penerima.required = true;
            bunga.required = true;
            jumlahTangkai.required = true;
            hargaPerTangkai.required = true;
            hiasan.required = true;
            textarea.required = true;
            updateFlowerPricing();
            pengirim.focus();
        } else {
            wrapper.classList.add('d-none');
            pengirim.required = false;
            penerima.required = false;
            bunga.required = false;
            jumlahTangkai.required = false;
            hargaPerTangkai.required = false;
            hiasan.required = false;
            textarea.required = false;
            pengirim.value = '';
            penerima.value = '';
            bunga.value = '';
            jumlahTangkai.value = '';
            hargaPerTangkai.value = '';
            hiasan.value = '';
            textarea.value = '';
            document.getElementById('estimasiBiayaBunga').textContent = 'Rp 0';
            updateCheckoutSummary();
            hitungKembalian();
        }
    }

    function validateCheckout() {
        const method = document.getElementById('payment_method').value;
        const bayarInput = parseFloat(document.getElementById('bayar').value) || 0;
        const hasGreetingCard = document.getElementById('ada_kartu_ucapan')?.checked;
        const totalCheckout = getTotalCheckout();

        if (!method) {
            alert('Silakan pilih metode pembayaran terlebih dahulu!');
            return false;
        }

        if (totalPembayaran <= 0 && !hasGreetingCard) {
            alert('Keranjang belanja masih kosong!');
            return false;
        }

        if (method === 'CASH' && bayarInput < totalCheckout) {
            alert('Uang pembayaran masih kurang!');
            return false;
        }
        return true;
    }
</script>

@endsection