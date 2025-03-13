<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('status', 'available')->count();
        $borrowedBooks = Book::where('status', 'borrowed')->count();

        return view('admin.dashboard', compact('totalBooks', 'availableBooks', 'borrowedBooks'));
    }
}
