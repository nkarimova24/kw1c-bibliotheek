@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold mb-4">Bibliotheek</h1>

    <div class="row">
        {{-- Overzicht Boeken --}}
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
