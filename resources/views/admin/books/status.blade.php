@extends('layouts.app')

@section('title', 'Status Buku')

@section('content')
<div class="page-header">
    <h2 class="mb-2"><i class="bi bi-clipboard-data"></i> Status Buku</h2>
    <p class="mb-0">Daftar semua buku beserta status peminjaman</p>
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
                                <th><i class="bi bi-info-circle"></i> Status Buku</th>
                                <th><i class="bi bi-people"></i> Peminjam</th>
                                <th><i class="bi bi-calendar"></i> Tanggal Pinjam</th>
                                <th><i class="bi bi-info-circle"></i> Status Peminjaman</th>
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
                                        @php
                                            $activeLoan = $book->loans->where('status', 'dipinjam')->first();
                                        @endphp
                                        @if($activeLoan)
                                            <span class="badge bg-info text-dark">
                                                <i class="bi bi-person"></i> {{ $activeLoan->user->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activeLoan)
                                            <i class="bi bi-calendar-event"></i> {{ $activeLoan->tanggal_pinjam->format('d/m/Y') }}
                                            <br>
                                            <small class="text-muted">
                                                <i class="bi bi-clock"></i> {{ $activeLoan->tanggal_pinjam->format('H:i') }}
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($activeLoan)
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
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
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
