<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('genre');

        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        if ($request->filled('author')) {
            $query->where('author', $request->author);
        }

        if ($request->filled('publisher')) {
            $query->where('publisher', $request->publisher);
        }

        $books = $query->get();

        $genres = Genre::when($request->filled('author') || $request->filled('publisher'), function ($q) use ($request) {
            if ($request->filled('author')) {
                $q->whereHas('books', function ($query) use ($request) {
                    $query->where('author', $request->author);
                });
            }
            if ($request->filled('publisher')) {
                $q->whereHas('books', function ($query) use ($request) {
                    $query->where('publisher', $request->publisher);
                });
            }
        })->pluck('name', 'id');

        $authors = Book::when($request->filled('genre_id') || $request->filled('publisher'), function ($q) use ($request) {
            if ($request->filled('genre_id')) {
                $q->where('genre_id', $request->genre_id);
            }
            if ($request->filled('publisher')) {
                $q->where('publisher', $request->publisher);
            }
        })->select('author')->distinct()->pluck('author');

        $publishers = Book::when($request->filled('genre_id') || $request->filled('author'), function ($q) use ($request) {
            if ($request->filled('genre_id')) {
                $q->where('genre_id', $request->genre_id);
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
