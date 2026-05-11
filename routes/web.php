<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ManageListController;
use App\Http\Controllers\DeletesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index', ['status' => 'todo']);
});

// Resource route handles: index, create, store, show, edit, update, destroy
Route::resource('tasks', TaskController::class)->except(['show']); // 'show' not needed (using modal instead)

// Additional routes for manage, deleted, restore, and force delete
Route::get('/tasks/manage', [ManageListController::class, 'manage'])->name('tasks.manage');
Route::get('/tasks/deleted', [DeletesController::class, 'deleted'])->name('tasks.deleted');
Route::post('/tasks/restore/{id}', [DeletesController::class, 'restore'])->name('tasks.restore');
Route::delete('/tasks/force-delete/{id}', [DeletesController::class, 'forceDelete'])->name('tasks.forceDelete');
