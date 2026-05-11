<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Main index with status filtering (To Do, In Progress, Completed, Submitted) - NO "All" tab
    public function index(Request $request)
    {
        $status = $request->get('status', 'todo'); // Default to 'todo'

        $query = Task::whereNull('deleted_at')->where('status', $status);

        $tasks = $query->orderBy('deadline')->paginate(10);

        return view('index', compact('tasks', 'status'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(TaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index', ['status' => 'todo'])->with('success', 'Task created successfully.');
    }

    public function edit(string $id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        return view('edit', compact('task'));
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $task->update($request->validated());
        return redirect()->route('tasks.index', ['status' => 'todo'])->with('success', 'Task updated successfully.');
    }

    // Soft delete – move to trash
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Task moved to deleted.');
    }
}
