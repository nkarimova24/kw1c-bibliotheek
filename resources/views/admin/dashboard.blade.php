@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold mb-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Totaal Boeken</h5>
                <h2>{{ $totalBooks }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Beschikbare Boeken</h5>
                <h2>{{ $availableBooks }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <h5>Uitgeleende Boeken</h5>
                <h2>{{ $borrowedBooks }}</h2>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/admin/books') }}" class="btn btn-primary">Boeken Beheren</a>
    </div>
</div>
@endsection
