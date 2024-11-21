<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Routes protégées par l'authentification
Route::middleware('auth')->group(function () {

    // Affiche toutes les tâches de l'utilisateur connecté
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Affiche un formulaire pour ajouter une nouvelle tâche
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Enregistre une nouvelle tâche dans la base de données
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Affiche un formulaire pour modifier une tâche
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // Met à jour les informations d'une tâche
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    // Supprime une tâche spécifique
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Affiche les détails d’une tâche spécifique
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

});
