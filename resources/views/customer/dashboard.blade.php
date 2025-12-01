@extends('layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
<div class="page-header">
    <h2 class="mb-2"><i class="bi bi-person-circle"></i> Dashboard Customer</h2>
    <p class="mb-0">Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
</div>

<div class="row mb-4">
    <div class="col-md-6">
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
    <div class="col-md-6">
        <div class="stat-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase mb-1" style="opacity: 0.9;">Buku Dipinjam</h6>
                    <h2 class="mb-0">{{ $userLoans->count() }}</h2>
                </div>
                <i class="bi bi-bookmark-check" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card card-modern">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-list-ul"></i> Daftar Buku</h4>
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
                                        @if($book->isAvailable())
                                            <form action="{{ route('customer.books.borrow', $book) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-modern btn-primary btn-sm">
                                                    <i class="bi bi-bookmark-plus"></i> Pinjam
                                                </button>
                                            </form>
                                        @else
                                            @php
                                                $userLoan = $userLoans->firstWhere('book_id', $book->id);
                                            @endphp
                                            @if($userLoan)
                                                <form action="{{ route('customer.loans.return', $userLoan) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-modern btn-success btn-sm">
                                                        <i class="bi bi-arrow-counterclockwise"></i> Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted"><i class="bi bi-lock"></i> Sedang dipinjam</span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                        <p class="text-muted mt-2">Tidak ada buku tersedia</p>
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

@if($userLoans->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card card-modern">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h4 class="mb-0"><i class="bi bi-bookmark-heart"></i> Buku yang Saya Pinjam</h4>
            </div>
            <div class="card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table table-modern table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="bi bi-book"></i> Judul Buku</th>
                                <th><i class="bi bi-person"></i> Penulis</th>
                                <th><i class="bi bi-calendar"></i> Tanggal Pinjam</th>
                                <th><i class="bi bi-gear"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userLoans as $loan)
                                <tr>
                                    <td><strong>{{ $loan->book->title }}</strong></td>
                                    <td>{{ $loan->book->author }}</td>
                                    <td>
                                        <i class="bi bi-calendar-event"></i> {{ $loan->tanggal_pinjam->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> {{ $loan->tanggal_pinjam->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <form action="{{ route('customer.loans.return', $loan) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-modern btn-success btn-sm">
                                                <i class="bi bi-arrow-counterclockwise"></i> Kembalikan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
