<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('genre');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhereHas('genre', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        $books = $query->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.books.create', compact('genres'));
    }

    public function store(Request $request)
    {
        Log::info('Nieuwe boek-aanvraag ontvangen:', $request->all());

        if (!Genre::where('id', $request->genre_id)->exists()) {
            Log::error("Ongeldige genre_id ontvangen:", ['genre_id' => $request->genre_id]);
            return back()->withErrors(['genre_id' => 'Ongeldig genre geselecteerd.'])->withInput();
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
            'year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'loan_period' => 'nullable|integer|min:1|max:60',
        ]);

        try {
            $book = new Book();
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->publisher = $validated['publisher'] ?? null;
            $book->genre_id = $validated['genre_id'] ?? null;
            $book->year_published = $validated['year'] ?? null;
            $book->description = $validated['description'] ?? null;
            $book->status = $request->status ?? 'available';
            $book->loan_period = $validated['loan_period'] ?? 21;
            $book->save();

            Log::info("Boek succesvol opgeslagen:", ['boek_id' => $book->id]);
            return redirect()->route('admin.books.index')->with('success', 'Boek succesvol toegevoegd!');
        } catch (\Exception $e) {
            Log::error("Fout bij opslaan boek:", ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Er is een fout opgetreden bij het opslaan van het boek.'])->withInput();
        }
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        Log::info("Boek bijwerken:", ['boek_id' => $book->id, 'data' => $request->all()]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'status' => 'required|in:available,borrowed',
            'loan_period' => 'required|integer|min:1',
        ]);

        try {
            $book->update($validated);
            Log::info("Boek succesvol bijgewerkt:", ['boek_id' => $book->id]);
            return redirect()->route('admin.books.index')->with('success', 'Boek succesvol bijgewerkt!');
        } catch (\Exception $e) {
            Log::error("Fout bij bijwerken boek:", ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Er is een fout opgetreden bij het bijwerken van het boek.'])->withInput();
        }
    }

    public function destroy(Book $book)
    {
        try {
            $book->delete();
            Log::info("Boek succesvol verwijderd:", ['boek_id' => $book->id]);
            return redirect()->route('admin.books.index')->with('success', 'Boek succesvol verwijderd!');
        } catch (\Exception $e) {
            Log::error("Fout bij verwijderen boek:", ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Er is een fout opgetreden bij het verwijderen van het boek.']);
        }
    }
}
