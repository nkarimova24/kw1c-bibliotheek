@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ isset($book) ? 'Bewerk Boek' : 'Nieuw Boek Toevoegen' }}</h1>

    <form action="{{ isset($book) ? route('admin.books.update', $book->id) : route('admin.books.store') }}" method="POST">
        @csrf
        @isset($book)
            @method('PUT')
        @endisset
        @include('admin.books.form')
        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>

    <div id="error-message" class="alert alert-danger mt-3" style="display:none;"></div>
</div>

<script>
function addNewGenre() {
    let newGenre = document.getElementById('new_genre').value.trim();
    let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

    if (!csrfTokenMeta) {
        console.error("CSRF-token ontbreekt in de pagina!");
        alert("Er is een fout opgetreden. CSRF-token ontbreekt!");
        return;
    }

    let token = csrfTokenMeta.getAttribute('content');

    if (newGenre !== '') {
        fetch('{{ route("admin.genres.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ name: newGenre })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let select = document.querySelector('select[name="genre_id"]');
                let option = document.createElement('option');
                option.value = data.id;
                option.text = data.name;
                option.selected = true;
                select.appendChild(option);

                document.getElementById('new_genre').value = '';
                document.getElementById('genre_message').style.display = 'block';
                setTimeout(() => document.getElementById('genre_message').style.display = 'none', 3000);
            } else {
                console.error('Fout bij opslaan:', data);
                alert('Er is een fout opgetreden. Controleer de console.');
            }
        })
        .catch(error => console.error('Fetch Error:', error));
    }
}

</script>
@endsection
