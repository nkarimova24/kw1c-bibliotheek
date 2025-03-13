@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold">Boeken Beheer</h1>
    <a href="{{ route('admin.books.create')}}" class="btn btn-success mb-3">+ Nieuw Boek</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->genre ?? 'Onbekend' }}</td>
                    <td><span class="badge bg-{{ $book->status == 'available' ? 'success' : 'danger' }}">{{ ucfirst($book->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning btn-sm">Bewerken</a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je dit boek wilt verwijderen?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $books->links() }}
</div>
@endsection