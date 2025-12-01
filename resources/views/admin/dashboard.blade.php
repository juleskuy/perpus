@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header">
    <h2 class="mb-2"><i class="bi bi-shield-check"></i> Dashboard Admin</h2>
    <p class="mb-0">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-1" style="opacity: 0.9;">Total Buku</h6>
                    <h2 class="mb-0">{{ $books->count() }}</h2>
                </div>
                <i class="bi bi-book" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-1" style="opacity: 0.9;">Buku Tersedia</h6>
                    <h2 class="mb-0">{{ $books->where('status', 'tersedia')->count() }}</h2>
                </div>
                <i class="bi bi-check-circle" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-1" style="opacity: 0.9;">Buku Dipinjam</h6>
                    <h2 class="mb-0">{{ $books->where('status', 'dipinjam')->count() }}</h2>
                </div>
                <i class="bi bi-clock-history" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-modern">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-ul"></i> Daftar Buku</h4>
                    <a href="{{ route('admin.books.create') }}" class="btn btn-modern btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Buku
                    </a>
                </div>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-modern table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-book"></i> Judul</th>
                                <th><i class="bi bi-person"></i> Penulis</th>
                                <th><i class="bi bi-info-circle"></i> Status</th>
                                <th><i class="bi bi-people"></i> Dipinjam Oleh</th>
                                <th><i class="bi bi-gear"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td><strong>{{ $book->title }}</strong></td>
                                    <td>{{ $book->author }}</td>
                                    <td>
                                        @if($book->isAvailable())
                                            <span class="badge badge-modern bg-success">
                                                <i class="bi bi-check-circle"></i> Tersedia
                                            </span>
                                        @else
                                            <span class="badge badge-modern bg-warning text-dark">
                                                <i class="bi bi-clock-history"></i> Dipinjam
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->loans->where('status', 'dipinjam')->count() > 0)
                                            @foreach($book->loans->where('status', 'dipinjam') as $loan)
                                                <span class="badge bg-info text-dark mb-1">
                                                    <i class="bi bi-person"></i> {{ $loan->user->name }}
                                                </span><br>
                                            @endforeach
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Yakin ingin menghapus buku ini?')" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-2">Tidak ada buku</p>
                                    </td>
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
