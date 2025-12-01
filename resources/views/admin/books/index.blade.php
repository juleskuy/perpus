@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-2"><i class="bi bi-book"></i> Kelola Buku</h2>
            <p class="mb-0">Manajemen data buku perpustakaan</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-modern btn-light">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-modern">
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-modern table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-book"></i> Judul</th>
                                <th><i class="bi bi-person"></i> Penulis</th>
                                <th><i class="bi bi-info-circle"></i> Status</th>
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
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.books.show', $book) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
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
                                    <td colspan="4" class="text-center py-4">
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
