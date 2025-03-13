<div class="mb-3">
    <label class="form-label">Titel</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label">Auteur</label>
    <input type="text" name="author" class="form-control" value="{{ old('author', $book->author ?? '') }}" required>
</div>
