<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang Kami - Blossom POS</title>
  
  <!-- Font & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --primary: #a8204d;
      --primary-dark: #801336;
      --primary-light: #fce8ed;
      --accent: #f2c7d4;
      --bg-light: #fff9fb;
      --text-main: #332228;
      --text-muted: #725d66;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Plus Jakarta Sans", sans-serif;
      color: var(--text-main);
      background-color: var(--bg-light);
      line-height: 1.7;
    }

    /* Navbar Modern */
    .navbar {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      position: sticky;
      top: 0;
      z-index: 1000;
      padding: 18px 5%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 20px rgba(168, 32, 77, 0.05);
    }

    .navbar .brand {
      font-weight: 800;
      font-size: 1.4rem;
      color: var(--primary);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar .btn-back {
      background-color: var(--primary-light);
      color: var(--primary);
      padding: 8px 20px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .navbar .btn-back:hover {
      background-color: var(--primary);
      color: #ffffff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(168, 32, 77, 0.25);
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: #ffffff;
      padding: 90px 20px 120px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -50px;
      left: 0;
      width: 100%;
      height: 100px;
      background: var(--bg-light);
      transform: skewY(-2deg);
    }

    .hero-badge {
      display: inline-block;
      background: rgba(255, 255, 255, 0.15);
      padding: 6px 18px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 20px;
      backdrop-filter: blur(5px);
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 15px;
      letter-spacing: -0.5px;
    }

    .hero p {
      font-size: 1.2rem;
      opacity: 0.9;
      max-width: 600px;
      margin: 0 auto;
    }

    /* Layout Container */
    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* About Section */
    .about-card {
      background: #ffffff;
      border-radius: 24px;
      padding: 50px;
      margin-top: -60px;
      position: relative;
      z-index: 10;
      box-shadow: 0 20px 40px rgba(168, 32, 77, 0.08);
      text-align: center;
    }

    .section-title {
      color: var(--primary);
      font-size: 2rem;
      font-weight: 800;
      margin-bottom: 15px;
    }

    .about-card p {
      color: var(--text-muted);
      font-size: 1.1rem;
      max-width: 800px;
      margin: 0 auto 40px;
    }

    /* Stats Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      border-top: 1px solid var(--primary-light);
      padding-top: 40px;
    }

    .stat-item h4 {
      font-size: 2.2rem;
      color: var(--primary);
      font-weight: 800;
    }

    .stat-item p {
      font-size: 0.9rem;
      margin-bottom: 0;
      font-weight: 600;
    }

    /* Services Section */
    .services {
      padding: 80px 0;
    }

    .services-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .card {
      background-color: #ffffff;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
      border: 1px solid rgba(168, 32, 77, 0.08);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(168, 32, 77, 0.12);
      border-color: var(--primary);
    }

    .icon-wrapper {
      width: 60px;
      height: 60px;
      background: var(--primary-light);
      color: var(--primary);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin-bottom: 25px;
    }

    .card h3 {
      color: var(--text-main);
      margin-bottom: 12px;
      font-size: 1.3rem;
      font-weight: 700;
    }

    .card p {
      color: var(--text-muted);
      font-size: 0.98rem;
    }

    /* Footer Section */
    .footer {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: #ffffff;
      padding: 60px 0 30px;
      margin-top: 40px;
    }

    .contact-card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }

    .contact-item {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(5px);
      padding: 25px;
      border-radius: 16px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact-item i {
      font-size: 1.8rem;
      margin-bottom: 10px;
      display: block;
      color: var(--accent);
    }

    .contact-item p {
      margin: 0;
      font-size: 0.95rem;
    }

    .copyright {
      text-align: center;
      margin-top: 50px;
      padding-top: 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 0.85rem;
      opacity: 0.7;
    }

    @media (max-width: 768px) {
      .hero h1 { font-size: 2.2rem; }
      .about-card { padding: 30px 20px; }
      .section-title { font-size: 1.6rem; }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <a href="#" class="brand">
      <i class="bi bi-flower1"></i> Blossom POS
    </a>
    <a href="dashboard" class="btn-back">
      <i class="bi bi-arrow-left"></i> Dashboard
    </a>
  </nav>

  <!-- Hero Section -->
  <header class="hero">
    <span class="hero-badge">Est. 2018</span>
    <h1>Blossom Florist</h1>
    <p>Menghadirkan Keindahan Alam ke Dalam Setiap Momen Berharga Anda</p>
  </header>

  <!-- Profil & Info Utama -->
  <main class="container">
    <section class="about-card">
      <h2 class="section-title">Tentang Kami</h2>
      <p>
        Berdiri sejak tahun 2018, <strong>Blossom Florist</strong> adalah toko bunga terpercaya yang berdedikasi merangkai bunga segar berkualitas tinggi. Kami menggabungkan seni merangkai bunga dan profesionalisme layanan untuk menyempurnakan hari istimewa Anda.
      </p>

      <!-- Statistik Tambahan -->
      <div class="stats-grid">
        <div class="stat-item">
          <h4>6+</h4>
          <p>Tahun Pengalaman</p>
        </div>
        <div class="stat-item">
          <h4>10k+</h4>
          <p>Buket Terkirim</p>
        </div>
        <div class="stat-item">
          <h4>100%</h4>
          <p>Bunga Segar Pilihan</p>
        </div>
      </div>
    </section>

    <!-- Layanan Section -->
    <section class="services">
      <div class="services-header">
        <h2 class="section-title">Layanan Unggulan</h2>
        <p style="color: var(--text-muted);">Solusi rangkaian bunga terbaik untuk segala kebutuhan acara Anda</p>
      </div>

      <div class="card-grid">
        <div class="card">
          <div class="icon-wrapper">
            <i class="bi bi-gift"></i>
          </div>
          <h3>Buket Custom</h3>
          <p>Rangkaian buket bunga segar eksklusif yang dirancang khusus sesuai keinginan dan anggaran Anda.</p>
        </div>

        <div class="card">
          <div class="icon-wrapper">
            <i class="bi bi-buildings"></i>
          </div>
          <h3>Dekorasi Acara</h3>
          <p>Penataan bunga elegan untuk pernikahan, ulang tahun, hingga acara formal perusahaan.</p>
        </div>

        <div class="card">
          <div class="icon-wrapper">
            <i class="bi bi-truck"></i>
          </div>
          <h3>Pengiriman Sameday</h3>
          <p>Layanan kirim cepat pada hari yang sama untuk memastikan bunga tetap segar hingga di penerima.</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer / Kontak -->
  <footer class="footer">
    <div class="container">
      <div style="text-align: center;">
        <h2 style="color: #ffffff; font-weight: 800;">Hubungi Kami</h2>
        <p style="opacity: 0.8;">Kami siap membantu mewujudkan rangkaian bunga impian Anda</p>
      </div>

      <div class="contact-card-grid">
        <div class="contact-item">
          <i class="bi bi-geo-alt"></i>
          <p><strong>Alamat</strong><br>Jl. Mawar No. 12, Bandung</p>
        </div>
        <div class="contact-item">
          <i class="bi bi-whatsapp"></i>
          <p><strong>WhatsApp</strong><br>0812-3456-7890</p>
        </div>
        <div class="contact-item">
          <i class="bi bi-instagram"></i>
          <p><strong>Instagram</strong><br>@blossom.pos</p>
        </div>
      </div>

      <div class="copyright">
        &copy; 2026 Blossom POS. All rights reserved.
      </div>
    </div>
  </footer>

</body>
</html>