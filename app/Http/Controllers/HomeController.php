<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Laptop;
use App\Models\Loan;

class HomeController extends Controller
{
    public function index()
    {
        // Ophalen van boeken en laptops
        $availableBooks = Book::where('status', 'available')->get();
        $borrowedBooks = Book::where('status', 'borrowed')->get();
        $availableLaptops = Laptop::where('status', 'available')->get();
        $borrowedLaptops = Laptop::where('status', 'borrowed')->get();
        $overdueLoans = Loan::where('status', 'overdue')->count();

        return view('home', compact('availableBooks', 'borrowedBooks', 'availableLaptops', 'borrowedLaptops', 'overdueLoans'));
    }
}
