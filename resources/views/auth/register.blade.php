@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <div class="card auth-card">
            <div class="auth-header">
                <h3 class="mb-2"><i class="bi bi-person-plus"></i> Register</h3>
                <p class="mb-0">Buat akun baru</p>
            </div>
            <div class="auth-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="bi bi-person"></i> Nama
                        </label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="Masukkan nama lengkap" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="nama@email.com" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Minimal 8 karakter" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-bold">
                            <i class="bi bi-lock-fill"></i> Konfirmasi Password
                        </label>
                        <input type="password" class="form-control form-control-lg" 
                               id="password_confirmation" name="password_confirmation" 
                               placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn btn-modern btn-primary w-100 py-3">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="fw-bold" style="color: var(--primary-color);">
                            Login disini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
