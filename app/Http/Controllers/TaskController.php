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

    // Restore a single soft-deleted task
    public function restore(string $id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.deleted')->with('success', 'Task restored successfully.');
    }

        // Manage List – shows active tasks with filters, search, and sort by ID
    public function manage(Request $request)
    {
        $query = Task::whereNull('deleted_at');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('task_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status_filter')) {
            $query->where('status', $request->status_filter);
        }

        // Priority filter
        if ($request->filled('priority_filter')) {
            $query->where('priority', $request->priority_filter);
        }

        // Sort by ID
        $sortOrder = $request->get('sort', 'asc'); // default descending
        $query->orderBy('id', $sortOrder);

        $tasks = $query->paginate(10);

        return view('manage', compact('tasks', 'sortOrder'));
    }

    // Deleted tasks – shows soft-deleted tasks with restore & force delete
    public function deleted()
    {
        $tasks = Task::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
        return view('deleted', compact('tasks'));
    }

    // Permanently delete a single soft-deleted task
    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.deleted')->with('success', 'Task permanently deleted.');
    }
}
