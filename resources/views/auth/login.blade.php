@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-5">
        <div class="card auth-card">
            <div class="auth-header">
                <h3 class="mb-2"><i class="bi bi-box-arrow-in-right"></i> Login</h3>
                <p class="mb-0">Masuk ke akun Anda</p>
            </div>
            <div class="auth-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="nama@email.com" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Masukkan password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-modern btn-primary w-100 py-3">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0">Belum punya akun? 
                        <a href="{{ route('register') }}" class="fw-bold" style="color: var(--primary-color);">
                            Daftar disini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
