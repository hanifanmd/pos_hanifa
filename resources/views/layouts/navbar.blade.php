<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi POS - Toko Bunga</title>
    <!-- Contoh menyertakan CSS Bootstrap (jika belum ada di layout utama) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Kustomisasi Navbar Tema Pink Toko Bunga & Sudut Tumpul */
        .navbar-custom {
            background: linear-gradient(135deg, #db2777 0%, #831843 100%) !important;
            box-shadow: 0 6px 15px rgba(219, 39, 119, 0.2);
            border-radius: 0 0 20px 20px; /* Membuat ujung bawah navbar melengkung/tumpul */
            padding-top: 12px;
            padding-bottom: 12px;
        }

        /* Warna Brand/Logo */
        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 1.25rem;
        }

        /* Warna Link Menu dengan Ujung Tumpul */
        .navbar-custom .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            transition: all 0.3s ease;
            border-radius: 10px; /* Ujung lebih tumpul */
            padding: 8px 14px;
            margin: 0 3px;
            font-weight: 500;
        }

        /* Efek Hover dan Active pada Link */
        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        /* Tombol Toggler (Hamburger) untuk Mobile dengan Ujung Tumpul */
        .navbar-custom .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
            padding: 6px 10px;
        }

        .navbar-custom .navbar-toggler-icon {
            filter: brightness(0) invert(1);
        }

        /* Kustomisasi Tombol Keluar agar Selaras dan Tumpul */
        .navbar-custom .btn-logout {
            background-color: #ffffff;
            color: #be185d;
            font-weight: 600;
            border-radius: 10px; /* Ujung tumpul */
            padding: 8px 18px;
            transition: all 0.3s ease;
            border: none;
        }

        .navbar-custom .btn-logout:hover {
            background-color: #fce7f3;
            color: #9d174d;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <!-- Navbar POS Toko Bunga -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid px-3">
        <a class="navbar-brand" href="#">🌷 Blossom POS</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Menu Utama di Sebelah Kiri -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Halaman utama</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Akun</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
            </li>
          </ul>

          <!-- Tombol Logout di Sebelah Kanan -->
          <div class="d-flex mt-3 mt-lg-0">
            <form action="{{ route('logout') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="btn btn-logout">Keluar</button>
            </form>
          </div>

        </div>
      </div>
    </nav>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>