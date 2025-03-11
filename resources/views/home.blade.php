@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold mb-4">Bibliotheek</h1>

    {{-- Filtermenu --}}
    <div class="card p-4 mb-4">
        <h5 class="fw-bold">Filter Boeken</h5>
        <form method="GET" action="{{ route('home') }}" class="row g-3">
            {{-- Genre filter --}}
            <div class="col-md-3">
                <label for="genre" class="form-label">Genre</label>
                <select name="genre" id="genre" class="form-select" onchange="this.form.submit()">
                    <option value="">Alle genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Auteur filter --}}
            <div class="col-md-3">
                <label for="author" class="form-label">Auteur</label>
                <select name="author" id="author" class="form-select" onchange="this.form.submit()">
                    <option value="">Alle auteurs</option>
                    @foreach($authors as $author)
                        <option value="{{ $author }}" {{ request('author') == $author ? 'selected' : '' }}>
                            {{ $author }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Uitgever filter --}}
            <div class="col-md-3">
                <label for="publisher" class="form-label">Uitgever</label>
                <select name="publisher" id="publisher" class="form-select" onchange="this.form.submit()">
                    <option value="">Alle uitgevers</option>
                    @foreach($publishers as $publisher)
                        <option value="{{ $publisher }}" {{ request('publisher') == $publisher ? 'selected' : '' }}>
                            {{ $publisher }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Zoek- en resetknoppen --}}
            <div class="col-md-3 align-self-end d-flex">
                <button type="submit" class="btn btn-primary w-50 me-2">Filter</button>
                <a href="{{ route('home') }}" class="btn btn-secondary w-50">Reset</a>
            </div>
        </form>
    </div>

    {{-- Boekenoverzicht --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Beschikbare Boeken</h5>
                <ul class="list-group">
                    @forelse($availableBooks as $book)
                        <li class="list-group-item">
                            <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                                <strong>{{ $book->title }}</strong> - {{ $book->author }}
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Geen beschikbare boeken</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Geleende Boeken</h5>
                <ul class="list-group">
                    @forelse($borrowedBooks as $book)
                        <li class="list-group-item">
                            <a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">
                                <strong>{{ $book->title }}</strong> - {{ $book->author }}
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Geen boeken uitgeleend</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
