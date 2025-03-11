@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold mb-4">Welkom bij de Bibliotheek</h1>

    {{-- Notificatie voor admin als er te late leningen zijn --}}
    @auth
        @if(auth()->user()->hasRole('admin') && $overdueLoans > 0)
            <div class="alert alert-danger text-center">
                Er zijn <strong>{{ $overdueLoans }}</strong> leningen die te laat zijn ingeleverd.
            </div>
        @endif
    @endauth

    {{-- Zoekfunctie --}}
    <div class="card p-4 mb-4">
        <h5>Zoeken naar een boek of laptop</h5>
        <form method="GET" action="{{ route('home') }}" class="d-flex">
            <input type="text" name="search" placeholder="Titel, auteur of merk..." class="form-control me-2">
            <button type="submit" class="btn btn-primary">Zoeken</button>
        </form>
    </div>

    <div class="row">
        {{-- Overzicht Boeken --}}
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Beschikbare Boeken</h5>
                <ul class="list-group">
                    @forelse($availableBooks as $book)
                        <li class="list-group-item">
                            <strong>{{ $book->title }}</strong> - {{ $book->author }}
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
                            <strong>{{ $book->title }}</strong> - {{ $book->author }}
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Geen boeken uitgeleend</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- Overzicht Laptops --}}
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Beschikbare Laptops</h5>
                <ul class="list-group">
                    @forelse($availableLaptops as $laptop)
                        <li class="list-group-item">
                            <strong>{{ $laptop->brand }} {{ $laptop->model }}</strong>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Geen beschikbare laptops</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="fw-bold">Geleende Laptops</h5>
                <ul class="list-group">
                    @forelse($borrowedLaptops as $laptop)
                        <li class="list-group-item">
                            <strong>{{ $laptop->brand }} {{ $laptop->model }}</strong>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Geen laptops uitgeleend</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- Dashboard-link --}}
    @auth
        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-dark">Ga naar Dashboard</a>
        </div>
    @endauth
</div>
@endsection
