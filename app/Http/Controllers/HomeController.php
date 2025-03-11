<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        //filters
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        if ($request->filled('author')) {
            $query->where('author', $request->author);
        }

        if ($request->filled('publisher')) {
            $query->where('publisher', $request->publisher);
        }

        $books = $query->get();

        //filter alleen de relevante genres/auteurs/uitgevers op basis van de filterselectie
        $genres = Book::when($request->filled('author') || $request->filled('publisher'), function ($q) use ($request) {
            if ($request->filled('author')) {
                $q->where('author', $request->author);
            }
            if ($request->filled('publisher')) {
                $q->where('publisher', $request->publisher);
            }
        })->select('genre')->distinct()->pluck('genre');

        $authors = Book::when($request->filled('genre') || $request->filled('publisher'), function ($q) use ($request) {
            if ($request->filled('genre')) {
                $q->where('genre', $request->genre);
            }
            if ($request->filled('publisher')) {
                $q->where('publisher', $request->publisher);
            }
        })->select('author')->distinct()->pluck('author');

        $publishers = Book::when($request->filled('genre') || $request->filled('author'), function ($q) use ($request) {
            if ($request->filled('genre')) {
                $q->where('genre', $request->genre);
            }
            if ($request->filled('author')) {
                $q->where('author', $request->author);
            }
        })->select('publisher')->distinct()->pluck('publisher');

        return view('home', [
            'availableBooks' => $books->where('status', 'available'),
            'borrowedBooks' => $books->where('status', 'borrowed'),
            'genres' => $genres,
            'authors' => $authors,
            'publishers' => $publishers,
        ]);
    }
}
