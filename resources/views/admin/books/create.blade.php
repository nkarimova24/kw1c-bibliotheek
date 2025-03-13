@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ isset($book) ? 'Bewerk Boek' : 'Nieuw Boek Toevoegen' }}</h1>
    <form method="POST" action="{{ isset($book) ? route('admin.books.update', $book->id) : route('admin.books.store') }}">
        @csrf
        @isset($book) @method('PUT') @endisset
        @include('admin.books.form')
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
@endsection
