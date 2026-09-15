<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami - Blossom POS</title>
  <style>
    /* Reset CSS dasar */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #333333;
      background-color: #faf7f5;
      line-height: 1.6;
    }

    /* Navbar disesuaikan dengan tema Blossom POS */
    .navbar {
      background-color: #a82355; /* Warna tema Blossom POS */
      color: #ffffff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar .brand {
      font-weight: bold;
      font-size: 1.3rem;
      color: #ffffff;
      text-decoration: none;
    }

    .navbar .btn-back {
      background-color: #ffffff;
      color: #a82355;
      padding: 6px 16px;
      border-radius: 20px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .navbar .btn-back:hover {
      background-color: #f0f0f0;
    }

    /* Layout Container */
    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 40px 20px;
      text-align: center;
    }

    /* Hero Header */
    .hero {
      background-color: #c4386e;
      color: #ffffff;
      padding: 60px 20px;
      text-align: center;
    }

    .hero h1 {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    /* Judul Section */
    h2 {
      color: #a82355;
      margin-bottom: 20px;
      font-size: 1.8rem;
    }

    /* Grid Layanan */
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      background-color: #ffffff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      border-top: 4px solid #a82355;
    }

    .card h3 {
      color: #a82355;
      margin-bottom: 10px;
    }

    /* Footer / Kontak */
    .footer {
      background-color: #a82355;
      color: #ffffff;
      margin-top: 40px;
    }

    .footer h2 {
      color: #ffffff;
    }

    .footer p {
      margin: 5px 0;
    }
  </style>
</head>
<body>

  <!-- Navbar Aplikasi -->
  <nav class="navbar">
    <a href="#" class="brand">🌸 Blossom POS</a>
    <!-- Sesuaikan href dengan halaman penjualan/dashboard kamu -->
    <a href="dashboard" class="btn-back">← Kembali ke dashboard</a>
  </nav>

  <!-- Header / Hero Section -->
  <header class="hero">
    <div class="hero-content">
      <h1>Blossom Florist</h1>
      <p>Menghadirkan Keindahan Alam ke Dalam Momen Berharga Anda</p>
    </div>
  </header>

  <!-- Profil / About Section -->
  <section class="container about">
    <h2>Tentang Kami</h2>
    <p>
      Berdiri sejak tahun 2018, <strong>Blossom Florist</strong> adalah toko bunga pilihan yang berdedikasi merangkai bunga segar berkualitas tinggi untuk berbagai acara. Mulai dari buket wisuda, dekorasi pernikahan, hingga papan ucapan selamat.
    </p>
  </section>

  <!-- Layanan Section -->
  <section class="container services">
    <h2>Layanan Kami</h2>
    <div class="card-grid">
      <div class="card">
        <h3>Buket Custom</h3>
        <p>Rangkaian buket bunga segar yang disesuaikan dengan keinginan dan anggaran Anda.</p>
      </div>
      <div class="card">
        <h3>Dekorasi Acara</h3>
        <p>Penataan bunga untuk pernikahan, ulang tahun, dan acara perusahaan.</p>
      </div>
      <div class="card">
        <h3>Pengiriman Sameday</h3>
        <p>Layanan antar cepat untuk memastikan bunga tetap segar sampai di lokasi penerima.</p>
      </div>
    </div>
  </section>

  <!-- Kontak Section -->
  <footer class="footer">
    <div class="container">
      <h2>Hubungi Kami</h2>
      <p>📍 Jl. Mawar No. 12, Bandung</p>
      <p>📞 WhatsApp: 0812-3456-7890</p>
      <p>📷 Instagram: @blossom.pos</p>
    </div>
  </footer>

</body>
</html>