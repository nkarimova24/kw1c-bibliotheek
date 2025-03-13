<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'status' => 'required|in:available,borrowed',
        ]);

        Book::create($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Boek succesvol toegevoegd!');
    }

    public function edit(Book $book)
{
    return view('admin.books.edit', compact('book'));
}

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:100',
            'year_published' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
            'status' => 'required|in:available,borrowed',
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