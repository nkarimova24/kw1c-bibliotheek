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
   
        $books = $query->paginate(10);
    
        $genres = Genre::whereHas('books', function ($q) use ($request) {
            if ($request->filled('author')) {
                $q->where('author', $request->author);
            }
            if ($request->filled('publisher')) {
                $q->where('publisher', $request->publisher);
            }
        })->get();
    
        $authors = Book::when($request->filled('genre_id'), function ($q) use ($request) {
            $q->where('genre_id', $request->genre_id);
        })->distinct()->pluck('author');
    
        $publishers = Book::when($request->filled('genre_id'), function ($q) use ($request) {
            $q->where('genre_id', $request->genre_id);
        })->distinct()->pluck('publisher');
    
        if ($request->ajax()) {
            return response()->json([
                'books' => $books->items(), 
                'genres' => $genres,
                'authors' => $authors,
                'publishers' => $publishers
            ]);
        }
    
        return view('home', compact('books', 'genres', 'authors', 'publishers'));
    }
    
}