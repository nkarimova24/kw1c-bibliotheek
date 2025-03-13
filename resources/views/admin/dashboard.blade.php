@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.books.index') }}">
                            <i class="fas fa-book"></i> Boeken Beheren
                        </a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link text-white" href="{{ route('admin.loans.index') }}"> --}}
                            <i class="fas fa-exchange-alt"></i> Uitleningen
                        </a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link text-white" href="{{ route('admin.users.index') }}"> --}}
                            <i class="fas fa-users"></i> Gebruikers
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Dashboard Content --}}
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h1 class="mt-4 fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Overzicht van bibliotheekstatistieken</p>

            {{-- Dashboard Cards --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Totaal Boeken</h5>
                            <h2 class="fw-bold text-primary">{{ $totalBooks }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Beschikbare Boeken</h5>
                            <h2 class="fw-bold text-success">{{ $availableBooks }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Uitgeleende Boeken</h5>
                            <h2 class="fw-bold text-danger">{{ $borrowedBooks }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Geleende Boeken --}}
            <div class="mt-5">
                <h3 class="fw-bold">Recente Uitleningen</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Boek</th>
                            <th>Uitgeleend Aan</th>
                            <th>Uitleendatum</th>
                            <th>Terugbrengen Voor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentLoans as $loan)
                            <tr>
                                <td>{{ $loan->book->title }}</td>
                                <td>{{ $loan->user->first_name }} {{ $loan->user->last_name }}</td>
                                <td>{{ $loan->loan_date->format('d-m-Y') }}</td>
                                <td class="{{ $loan->return_date && $loan->return_date->lt(now()) ? 'text-danger' : '' }}">
                                    {{ $loan->return_date ? $loan->return_date->format('d-m-Y') : 'Nog niet ingeleverd' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Geen recente uitleningen</td>
                            </tr>
                        @endforelse
                    </tbody>
                    
                </table>
            </div>

        </main>
    </div>
</div>
@endsection
