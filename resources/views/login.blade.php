<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke tittle untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten -->
@section('content')

<!-- Custom Colorful & Animated Styling for Login (Pink Theme) -->
<style>
    body {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        min-height: 100vh;
        overflow: hidden;
    }
    .login-card {
        width: 22rem;
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(255, 117, 140, 0.25);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        animation: fadeInUp 0.8s ease-in-out;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }
    .login-header {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        color: white;
        border-top-left-radius: 20px !important;
        border-top-right-radius: 20px !important;
        padding: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #ff758c;
        box-shadow: 0 0 10px rgba(255, 117, 140, 0.25);
    }
    .btn-submit {
        background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
        border: none;
        border-radius: 50px;
        padding: 0.6rem 2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 117, 140, 0.4);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 117, 140, 0.6);
        background: linear-gradient(135deg, #e06279 0%, #e66a9d 100%);
    }
    .form-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.9rem;
    }
</style>

<div class="card text-center position-absolute top-50 start-50 translate-middle login-card">
    <h4 class="card-header login-header">🔐 Selamat datang</h4>
    <div class="card-body p-4">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" 
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan email...">
                @error('email')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4 text-start">
                <label for="exampleInputPassword1" class="form-label">Kata sandi</label>
                <input type="password" name="password" class="form-control" 
                id="exampleInputPassword1" placeholder="Masukkan password...">
                @error('password')
                    <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-submit text-white w-100">Masuk</button>
        </form>
    </div>
</div>

<!-- batas Akhir isi konten -->
@endsection