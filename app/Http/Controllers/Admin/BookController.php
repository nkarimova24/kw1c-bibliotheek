<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
// use illuminate log
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
        Log::info('Boek opslaan gestart', $request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'status' => 'nullable|in:available,borrowed',
            'loan_period' => 'nullable|integer|min:1',
        ]);

        $validated['loan_period'] = $validated['loan_period'] ?? 21; // Standaard 21 dagen

        Log::info('Geverifieerde data', $validated);

        $book = Book::create($validated);

        Log::info('Boek succesvol aangemaakt', ['book_id' => $book->id]);

        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol toegevoegd!');
    } catch (\Exception $e) {
        Log::error('Fout bij opslaan van boek', ['error' => $e->getMessage()]);
        return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het boek.');
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
            'loan_period' => 'required|integer|min:1',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol bijgewerkt!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol verwijderd!');
    }
}