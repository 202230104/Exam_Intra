@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter une Nouvelle Tâche</h2>

    <!-- Formulaire de création de tâche -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <!-- Titre -->
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Priorité -->
        <div class="mb-3">
            <label for="priority" class="form-label">Priorité</label>
            <select name="priority" class="form-control" required>
            <option value="basse" {{ old('priority') == 'basse' ? 'selected' : '' }}>Basse</option>
<option value="moyenne" {{ old('priority') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
<option value="haute" {{ old('priority') == 'haute' ? 'selected' : '' }}>Haute</option>

</select>

            @error('priority')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date Limite -->
        <div class="mb-3">
            <label for="due_date" class="form-label">Date Limite</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
            @error('due_date')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Créer la tâche</button>
    </form>
</div>
@endsection
