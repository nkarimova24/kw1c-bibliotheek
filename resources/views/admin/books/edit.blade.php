@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold">Boek Bewerken</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Titel</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Auteur</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Uitgever</label>
            <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Jaar</label>
            <input type="number" name="year_published" class="form-control" value="{{ old('year_published', $book->year_published) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Beschrijving</label>
            <textarea name="description" class="form-control">{{ old('description', $book->description) }}</textarea>
        </div>

        {{-- genre --}}
        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre_id" class="form-control">
                <option value="">-- Selecteer een genre --</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Beschikbaar</option>
                <option value="borrowed" {{ $book->status == 'borrowed' ? 'selected' : '' }}>Uitgeleend</option>
            </select>
        </div>

        {{-- leentermijn aanpassen --}}
        <div class="mb-3">
            <label class="form-label">Leentermijn (dagen)</label>
            <input type="number" name="loan_period" class="form-control" value="{{ old('loan_period', $book->loan_period) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
@endsection
