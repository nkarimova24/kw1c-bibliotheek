@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4">
        <h2 class="fw-bold">{{ $book->title }}</h2>
        <p><strong>Auteur:</strong> {{ $book->author }}</p>
        <p><strong>Uitgever:</strong> {{ $book->publisher ?? 'Onbekend' }}</p>
        <p><strong>Genre:</strong> {{ $book->genre ?? 'Onbekend' }}</p>
        <p><strong>Jaar van Uitgave:</strong> {{ $book->year_published ?? 'Onbekend' }}</p>
        <p><strong>Beschrijving:</strong> {{ $book->description ?? 'Geen beschrijving beschikbaar' }}</p>
        <p><strong>Status:</strong> <span class="badge bg-{{ $book->status === 'available' ? 'success' : 'danger' }}">{{ ucfirst($book->status) }}</span></p>
        
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Terug naar Home</a>
    </div>
</div>
@endsection
