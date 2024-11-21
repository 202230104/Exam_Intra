<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;




class TaskController extends Controller
{
 // Affiche toutes les tâches de l'utilisateur connecté
 public function index()
 {
     $tasks = Task::all();
     // Récupérer toutes les tâches triées par date de création 
     $tasks = Task::where('user_id', auth()->id())
     ->orderBy('created_at', 'desc')
     ->get();     return view('tasks.index', compact('tasks'));
 }

 // Affiche un formulaire pour ajouter une nouvelle tâche
 public function create()
 {
     return view('tasks.create');
 }

 // Enregistre une nouvelle tâche dans la base de données
 public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
'priority' => 'required|in:basse,moyenne,haute', 
        'due_date' => 'required|date',
    ]);

   $due_date = Carbon::parse($request->due_date);

    Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
      'due_date' => $due_date,
        'status' => $request->status ?? 0,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
}

public function edit($id)
{
    // Récupérer la tâche par ID
    $task = Task::findOrFail($id);

    return view('tasks.edit', compact('task'));
}


public function update(Request $request, $id)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'priority' => 'required|in:basse,moyenne,haute',
        'due_date' => 'nullable|date', // La date est optionnelle et doit être valide
    ]);

    // Trouver la tâche par son ID
    $task = Task::find($id);

    // Vérifier si la tâche existe
    if (!$task) {
        return redirect()->route('tasks.index')
            ->with('error', 'Tâche non trouvée.');
    }

    // Gestion du statut (toggle entre "ouverte" et "terminée")
    if ($request->has('status')) {
        $task->status = $task->status === 'terminée' ? 'ouverte' : 'terminée';
    }

    // Mise à jour des autres champs
    $task->title = $validatedData['title'];
    $task->description = $validatedData['description'];
    $task->priority = $validatedData['priority'];
    $task->due_date = $request->due_date ? Carbon::createFromFormat('Y-m-d', $request->due_date) : $task->due_date;

    // Enregistrer les modifications
    $task->save();

    // Rediriger avec un message de succès
    return redirect()->route('tasks.index')
        ->with('success', 'Tâche mise à jour avec succès.');
}



 // Supprime une tâche
 public function destroy($id)
 {
     $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
     $task->delete();

     return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
 }

 // Affiche les détails d’une tâche
 public function show($id)
 {
     $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
     return view('tasks.show', compact('task'));
 }


}
