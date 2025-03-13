<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name',
            ]);

            $genre = Genre::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Genre succesvol toegevoegd!',
                'id' => $genre->id,
                'name' => $genre->name,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Fout bij opslaan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
