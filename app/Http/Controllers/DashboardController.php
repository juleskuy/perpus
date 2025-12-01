<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }

    public function adminDashboard()
    {
        $books = \App\Models\Book::with('loans.user')->get();
        return view('admin.dashboard', compact('books'));
    }

    public function customerDashboard()
    {
        $books = \App\Models\Book::all();
        $userLoans = \App\Models\Loan::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->with('book')
            ->get();

        return view('customer.dashboard', compact('books', 'userLoans'));
    }
}
