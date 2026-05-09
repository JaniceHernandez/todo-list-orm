@extends('layouts.master')

@section('title', 'Manage Tasks')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fa fa-tasks"></i> Manage Tasks</h3>
        <div class="count-chip" style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 30px;">
            {{ $tasks->total() }} total
        </div>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('tasks.index', ['status' => 'todo']) }}">To Do</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'in_progress']) }}">In Progress</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'completed']) }}">Completed</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'submitted']) }}">Submitted</a></li>
            <li class="active"><a href="{{ route('tasks.manage') }}">Manage List</a></li>
            <li><a href="{{ route('tasks.deleted') }}"></i> Deleted</a></li>
        </ul>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" action="{{ route('tasks.manage') }}" class="form-inline" style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div style="flex: 2; min-width: 200px;">
                    <input type="text" name="search" class="form-control" placeholder="Search by task name or description..." value="{{ request('search') }}" style="width: 100%;">
                </div>
                <div style="min-width: 150px;">
                    <select name="status_filter" class="form-control" style="width: 100%;">
                        <option value="">All Statuses</option>
                        <option value="todo" {{ request('status_filter') == 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ request('status_filter') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="submitted" {{ request('status_filter') == 'submitted' ? 'selected' : '' }}>Submitted</option>
                    </select>
                </div>
                <div style="min-width: 200px;">
                    <select name="priority_filter" class="form-control" style="width: 100%;">
                        <option value="">All Priorities</option>
                        <option value="Urgent and Important" {{ request('priority_filter') == 'Urgent and Important' ? 'selected' : '' }}>Urgent and Important</option>
                        <option value="Important but Not Urgent" {{ request('priority_filter') == 'Important but Not Urgent' ? 'selected' : '' }}>Important but Not Urgent</option>
                        <option value="Urgent but Not Important" {{ request('priority_filter') == 'Urgent but Not Important' ? 'selected' : '' }}>Urgent but Not Important</option>
                        <option value="Not Urgent or Important" {{ request('priority_filter') == 'Not Urgent or Important' ? 'selected' : '' }}>Not Urgent or Important</option>
                    </select>
                </div>
                <div style="min-width: 180px;">
                    <select name="sort" class="form-control" style="width: 100%;">
                        <option value="asc" {{ request('sort', 'desc') == 'asc' ? 'selected' : '' }}>ID: Ascending</option>
                        <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>ID: Descending</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
                    <a href="{{ route('tasks.manage') }}" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
                </div>
            </form>
        </div>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="showDescription('{{ addslashes($task->task_name) }}', '{{ addslashes($task->description) }}')" class="clickable-task">
                                {{ $task->task_name }}
                            </a>
                            @if($task->description)
                                <br><small class="text-muted">{{ Str::limit($task->description, 50) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="priority-badge priority-{{ Str::slug($task->priority, '-') }}">
                                {{ $task->priority }}
                            </span>
                        </td>
                        <td>{{ $task->deadline->format('M d, Y') }}</td>
                        <td>
                            <span class="status-badge status-{{ str_replace('_', '-', $task->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Move this task to trash?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No tasks found. <a href="{{ route('tasks.create') }}">Add one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Task</a>
        </div>
        <div>
            {{ $tasks->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
