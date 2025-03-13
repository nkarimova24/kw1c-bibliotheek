<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('status', 'available')->count();
        $borrowedBooks = Book::where('status', 'borrowed')->count();

        $recentLoans = Loan::with(['book', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalBooks', 'availableBooks', 'borrowedBooks', 'recentLoans'));
    }
}
