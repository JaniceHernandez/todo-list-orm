<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        if ($status === 'manage') {
            $tasks = Task::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(10);
            return view('tasks.index', compact('tasks', 'status'));
        }

        $query = Task::whereNull('deleted_at');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $tasks = $query->orderBy('deadline')->paginate(10);

        return view('tasks.index', compact('tasks', 'status'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:Urgent & Important,Important but Not Urgent,Urgent but Not Important,Not Urgent or Important',
            'deadline'    => 'required|date',
            'status'      => 'required|in:todo,in_progress,completed,submitted',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'task_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:Urgent & Important,Important but Not Urgent,Urgent but Not Important,Not Urgent or Important',
            'deadline'    => 'required|date',
            'status'      => 'required|in:todo,in_progress,completed,submitted',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task moved to trash.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('task_ids', []);
        if (!empty($ids)) {
            Task::whereIn('id', $ids)->delete();
            return redirect()->route('tasks.index', ['status' => 'all'])
                             ->with('success', 'Selected tasks moved to trash.');
        }
        return redirect()->route('tasks.index', ['status' => 'all'])
                         ->with('error', 'No tasks selected.');
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.index', ['status' => 'manage'])
                         ->with('success', 'Task restored successfully.');
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.index', ['status' => 'manage'])
                         ->with('success', 'Task permanently deleted.');
    }
}
