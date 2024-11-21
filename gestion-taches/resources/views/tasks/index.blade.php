@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Affichage des messages de succès -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Liste des Tâches</h2>

    <!-- Vérifier s'il y a des tâches -->
    @if ($tasks->isEmpty())
        <div class="alert alert-info">
            Aucune tâche disponible. <a href="{{ route('tasks.create') }}">Créer une tâche</a>
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Priorité</th>
                    <th>Date Limite</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if ($task->priority == 'high')
                                <span class="badge bg-danger">Haute</span>
                            @elseif ($task->priority == 'medium')
                                <span class="badge bg-warning">Moyenne</span>
                            @else
                                <span class="badge bg-success">Basse</span>
                            @endif
                        </td>
                        <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') : 'Aucune date' }}</td>
                        <td>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>
        <input 
            type="checkbox" 
            name="status" 
            value="1" 
            onchange="this.form.submit()" 
            {{ $task->status === 1 ? 'checked' : '' }}>
        {{ $task->status === 1 ? 'Terminée' : 'Ouverte' }}
    </label>
</form>





                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">Détails</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
