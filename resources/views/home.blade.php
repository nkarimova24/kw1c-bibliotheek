@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="mb-3">Onze Boekencollectie</h2>
            <p class="lead text-muted">Ontdek boeken uit onze uitgebreide bibliotheek.</p>
        </div>
    </div>

    {{-- filters --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body bg-light rounded">
            <h5 class="mb-3"><i class="fas fa-filter me-2"></i>Filters</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="filter-genre" class="form-label small text-muted">Genre</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-bookmark"></i></span>
                        <select id="filter-genre" class="form-select">
                            <option value="">Alle genres</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="filter-author" class="form-label small text-muted">Auteur</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-user-edit"></i></span>
                        <select id="filter-author" class="form-select">
                            <option value="">Alle auteurs</option>
                            @foreach($authors as $author)
                                <option value="{{ $author }}">{{ $author }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="filter-publisher" class="form-label small text-muted">Uitgever</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-building"></i></span>
                        <select id="filter-publisher" class="form-select">
                            <option value="">Alle uitgevers</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher }}">{{ $publisher }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="book-list">
        @if ($books->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>Geen boeken gevonden met de huidige filters.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($books as $book)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text mb-1">
                                    <i class="fas fa-user-edit text-secondary me-2"></i>{{ $book->author }}
                                </p>
                                <p class="card-text mb-3">
                                    <span class="badge bg-secondary">{{ $book->genre->name ?? 'Onbekend' }}</span>
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Meer details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{--  paginatie-links --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = document.querySelectorAll('#filter-genre, #filter-author, #filter-publisher');
    
        filters.forEach(filter => {
            filter.addEventListener('change', function () {
                fetchBooks();
            });
        });
    
        function fetchBooks() {
            let genre = document.getElementById('filter-genre').value;
            let author = document.getElementById('filter-author').value;
            let publisher = document.getElementById('filter-publisher').value;
    
            fetch(`{{ route('home') }}?genre_id=${genre}&author=${author}&publisher=${publisher}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateBooks(data.books);
                updateFilters(data.genres, data.authors, data.publishers);
            })
            .catch(error => console.error('Error:', error));
        }
    
        function updateBooks(books) {
            let bookList = document.getElementById('book-list');
            if (books.length === 0) {
                bookList.innerHTML = `<div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Geen boeken gevonden met de huidige filters.
                </div>`;
                return;
            }
    
            let html = `<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">`;
            books.forEach(book => {
                html += `
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">${book.title}</h5>
                                <p class="card-text mb-1">
                                    <i class="fas fa-user-edit text-secondary me-2"></i>${book.author}
                                </p>
                                <p class="card-text mb-3">
                                    <span class="badge bg-secondary">${book.genre ? book.genre.name : 'Onbekend'}</span>
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary">Meer details</a>
                            </div>
                        </div>
                    </div>`;
            });
            html += `</div>`;
    
            bookList.innerHTML = html;
        }
    
        function updateFilters(genres, authors, publishers) {

            updateGenreDropdown('filter-genre', genres);
    
            updateInterdependentDropdown('filter-author', authors, 'filter-genre', 'filter-publisher');
            updateInterdependentDropdown('filter-publisher', publishers, 'filter-genre', 'filter-author');
        }
    
        function updateGenreDropdown(filterId, options) {
            let select = document.getElementById(filterId);
            let selectedValue = select.value;
            select.innerHTML = `<option value="">Alle genres</option>`;
            
            options.forEach(option => {
                let isSelected = selectedValue == option.id ? 'selected' : '';
                select.innerHTML += `<option value="${option.id}" ${isSelected}>${option.name}</option>`;
            });
        }
    
        function updateInterdependentDropdown(currentFilterId, options, filter1Id, filter2Id) {
            let currentSelect = document.getElementById(currentFilterId);
            let filter1Select = document.getElementById(filter1Id);
            let filter2Select = document.getElementById(filter2Id);
            
            let selectedValue = currentSelect.value;
            currentSelect.innerHTML = `<option value="">Alle ${currentFilterId === 'filter-author' ? 'auteurs' : 'uitgevers'}</option>`;
            
            //filteropties gebaseerd op gekozen filter
            let filter1Value = filter1Select.value;
            let filter2Value = filter2Select.value;
    
            options.forEach(option => {
                let isSelected = selectedValue == option ? 'selected' : '';
                currentSelect.innerHTML += `<option value="${option}" ${isSelected}>${option}</option>`;
            });
        }
    });
    </script>


@endsection
