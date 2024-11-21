@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la tâche</h2>

    <!-- Formulaire de modification de tâche -->
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf <!-- Protection CSRF -->
        @method('PUT') 

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="priority" class="form-label">Priorité</label>
            <select class="form-select" id="priority" name="priority" required>
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Basse</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Moyenne</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Haute</option>
            </select>
        </div>

        

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Mettre à jour la tâche</button>
    </form>
</div>
@endsection
