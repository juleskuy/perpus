<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function borrow(Book $book)
    {
        if (auth()->user()->isAdmin()) {
            abort(403, 'Admin tidak dapat meminjam buku.');
        }

        if (!$book->isAvailable()) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Buku sedang tidak tersedia.');
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'status' => 'dipinjam',
        ]);

        $book->update(['status' => 'dipinjam']);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Buku berhasil dipinjam.');
    }

    public function return(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($loan->isReturned()) {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Buku sudah dikembalikan.');
        }

        $loan->update([
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan',
        ]);

        $book = $loan->book;
        $hasActiveLoan = Loan::where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->exists();

        if (!$hasActiveLoan) {
            $book->update(['status' => 'tersedia']);
        }

        return redirect()->route('customer.dashboard')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}
