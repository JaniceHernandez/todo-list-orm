<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class ManageListController extends Controller
{
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
}
