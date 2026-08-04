<!DOCTYPE html>
<html lang="id">    
<head>
    <style>
    /* Paksa seluruh halaman memenuhi viewport tanpa margin */
    html, body {
        width: 100%;
        height: 100vh;
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Hilangkan scroll Samping */
    }

    /* Pastikan wrapper POS mengambil 100% lebar & tinggi */
    .page-wrapper {
        width: 100vw;
        min-height: 100vh;
        background-color: #fff0f3;
        padding: 15px; /* Jarak aman di dalam layar */
        box-sizing: border-box;
    }

    /* Jika pakai Bootstrap, pastikan melepaskan batas max-width */
    .container, .container-lg, .container-xl {
        max-width: 100% !important;
        width: 100% !important;
    }
</style>

    <meta charset="UTF-8">
    <!-- Isi title yang kita kirimkan dari views lain -->
    <title>@yield('title')</title>
    <!-- memanggil link bootstraps -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container">
 
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success')}}
    </div>
    @endif
    <!-- Isi konten yang kita kirimkan dari views lain -->
    @yield('content')

</div>

</body>
</html>
