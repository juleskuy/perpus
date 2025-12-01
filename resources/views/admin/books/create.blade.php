@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="page-header">
    <h2 class="mb-2"><i class="bi bi-plus-circle"></i> Tambah Buku</h2>
    <p class="mb-0">Tambah buku baru ke perpustakaan</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-modern">
            <div class="card-body p-4">
                <form action="{{ route('admin.books.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold">
                            <i class="bi bi-book"></i> Judul Buku
                        </label>
                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" 
                               placeholder="Masukkan judul buku" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author" class="form-label fw-bold">
                            <i class="bi bi-person"></i> Penulis
                        </label>
                        <input type="text" class="form-control form-control-lg @error('author') is-invalid @enderror" 
                               id="author" name="author" value="{{ old('author') }}" 
                               placeholder="Masukkan nama penulis" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold">
                            <i class="bi bi-info-circle"></i> Status
                        </label>
                        <select class="form-select form-select-lg @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                <i class="bi bi-check-circle"></i> Tersedia
                            </option>
                            <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>
                                <i class="bi bi-clock-history"></i> Dipinjam
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-modern btn-primary flex-fill">
                            <i class="bi bi-check-circle"></i> Simpan
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-modern btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
