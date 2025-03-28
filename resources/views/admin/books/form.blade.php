<div class="mb-3">
    <label class="form-label">Titel</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Auteur</label>
    <input type="text" name="author" class="form-control" value="{{ old('author', $book->author ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Uitgever</label>
    <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Jaar</label>
    <input type="text" name="year" class="form-control" value="{{ old('year', $book->year ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Beschrijving</label>
    <input type="text" name="description" class="form-control" value="{{ old('description', $book->description ?? '') }}" required>
</div>


{{-- Selecteer bestaand genre --}}
<select name="genre_id" class="form-control">
    <option value="">-- Selecteer een genre --</option>
    @foreach ($genres as $genre)
        <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id ?? '') == $genre->id ? 'selected' : '' }}>
            {{ $genre->name }}
        </option>
    @endforeach
</select>


{{-- Nieuw genre toevoegen --}}
<div class="mb-3">
    <label class="form-label">Nieuw Genre</label>
    <input type="text" id="new_genre" class="form-control" placeholder="Voer een nieuw genre in...">
    <button type="button" class="btn btn-secondary mt-2" onclick="addNewGenre()">Voeg toe</button>
</div>

<div id="genre_message" class="text-success" style="display: none;">Nieuw genre toegevoegd!</div>

<div class="mb-3">
    <label class="form-label">Leentermijn (dagen)</label>
    <input type="number" name="loan_period" class="form-control" value="{{ old('loan_period', $book->loan_period ?? 21) }}" required>
</div>


<script>
  function addNewGenre() {
    let newGenre = document.getElementById('new_genre').value.trim();
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    if (newGenre !== '') {
        fetch('{{ route("admin.genres.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ name: newGenre })
        })
        .then(response => response.text())  
        .then(data => {
            try {
                let jsonData = JSON.parse(data);
                console.log('Response:', jsonData);

                if (jsonData.success) {
                    let select = document.querySelector('select[name="genre_id"]');
                    let option = document.createElement('option');
                    option.value = jsonData.id;
                    option.text = jsonData.name;
                    option.selected = true;
                    select.appendChild(option);

                    document.getElementById('new_genre').value = ''; 
                    document.getElementById('genre_message').style.display = 'block';
                    setTimeout(() => document.getElementById('genre_message').style.display = 'none', 3000);
                } else {
                    console.error('Fout bij opslaan:', jsonData);
                    alert('Er is een fout opgetreden. Controleer de console.');
                }
            } catch (error) {
                console.error('Geen geldige JSON:', data); 
            }
        })
        .catch(error => console.error('Fetch Error:', error));
    }
}

</script>
