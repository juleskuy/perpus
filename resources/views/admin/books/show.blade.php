@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-2"><i class="bi bi-eye"></i> Detail Buku</h2>
            <p class="mb-0">Informasi lengkap buku</p>
        </div>
        <div>
            <a href="{{ route('admin.books.index') }}" class="btn btn-modern btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-modern btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-modern">
            <div class="card-body p-4">
                <dl class="row mb-0">
                    <dt class="col-sm-4 mb-3">
                        <i class="bi bi-book"></i> Judul
                    </dt>
                    <dd class="col-sm-8 mb-3">
                        <strong>{{ $book->title }}</strong>
                    </dd>

                    <dt class="col-sm-4 mb-3">
                        <i class="bi bi-person"></i> Penulis
                    </dt>
                    <dd class="col-sm-8 mb-3">
                        {{ $book->author }}
                    </dd>

                    <dt class="col-sm-4 mb-3">
                        <i class="bi bi-info-circle"></i> Status
                    </dt>
                    <dd class="col-sm-8 mb-3">
                        @if($book->isAvailable())
                            <span class="badge badge-modern bg-success">
                                <i class="bi bi-check-circle"></i> Tersedia
                            </span>
                        @else
                            <span class="badge badge-modern bg-warning text-dark">
                                <i class="bi bi-clock-history"></i> Dipinjam
                            </span>
                        @endif
                    </dd>
                </dl>
            </div>
        </div>

        <div class="card card-modern mt-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Riwayat Peminjaman</h5>
            </div>
            <div class="card-body px-4 pb-4">
                @if($book->loans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern table-hover mb-0">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-person"></i> Peminjam</th>
                                    <th><i class="bi bi-calendar"></i> Tanggal Pinjam</th>
                                    <th><i class="bi bi-calendar-check"></i> Tanggal Kembali</th>
                                    <th><i class="bi bi-info-circle"></i> Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->loans as $loan)
                                    <tr>
                                        <td><strong>{{ $loan->user->name }}</strong></td>
                                        <td>{{ $loan->tanggal_pinjam->format('d/m/Y H:i') }}</td>
                                        <td>{{ $loan->tanggal_kembali ? $loan->tanggal_kembali->format('d/m/Y H:i') : '-' }}</td>
                                        <td>
                                            @if($loan->isBorrowed())
                                                <span class="badge badge-modern bg-warning text-dark">
                                                    <i class="bi bi-clock-history"></i> Dipinjam
                                                </span>
                                            @else
                                                <span class="badge badge-modern bg-success">
                                                    <i class="bi bi-check-circle"></i> Dikembalikan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-2">Belum ada riwayat peminjaman.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
