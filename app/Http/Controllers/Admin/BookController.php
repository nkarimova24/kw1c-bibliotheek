<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.books.create', compact('genres'));
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
     
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Boek succesvol toegevoegd!',
            'data' => $book
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Fout bij opslaan: ' . $e->getMessage()
        ], 500);
    }
}

    
    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'status' => 'required|in:available,borrowed',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol bijgewerkt!');
    }

    public function destroy(Book $book)
{
    try {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol verwijderd!');
    } catch (\Exception $e) {
        return redirect()->route('admin.books.index')->with('error', 'Fout bij verwijderen: ' . $e->getMessage());
    }
}

}

