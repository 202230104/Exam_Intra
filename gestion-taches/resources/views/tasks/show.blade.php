@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la tâche</h2>

    <!-- Affichage des détails de la tâche -->
    <div class="card">
        <div class="card-header">
            <h3>{{ $task->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Priorité:</strong> 
                @switch($task->priority)
                    @case('low')
                        Basse
                        @break
                    @case('medium')
                        Moyenne
                        @break
                    @case('high')
                        Haute
                        @break
                    @default
                        Non définie
                @endswitch
            </p>
            <p><strong>Date limite:</strong> {{ \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') }}</p>
            <p><strong>Statut:</strong> 
                @if($task->status)
                    <span class="badge bg-success">Terminée</span>
                @else
                    <span class="badge bg-warning">Ouverte</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3">
        <!-- Lien pour modifier la tâche -->
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>

        <!-- Formulaire pour supprimer la tâche -->
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</button>
        </form>

        <!-- Lien pour revenir à la liste des tâches -->
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
</div>
@endsection
