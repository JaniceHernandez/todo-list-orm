<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class DeletesController extends Controller
{
    // Deleted tasks – shows soft-deleted tasks with restore & force delete
    public function deleted()
    {
        $tasks = Task::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('deleted', compact('tasks'));
    }

    // Restore a single soft-deleted task
    public function restore(string $id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.deleted')->with('success', 'Task restored successfully.');
    }

    // Permanently delete a single soft-deleted task
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.deleted')->with('success', 'Task permanently deleted.');
    }
}
