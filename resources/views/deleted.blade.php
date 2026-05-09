@extends('layouts.master')

@section('title', 'Deleted Tasks')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fa fa-tasks"></i> Deleted Tasks</h3>
        <div class="count-chip" style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 30px;">
            {{ $tasks->total() }} deleted
        </div>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs">
            <li><a href="{{ route('tasks.index', ['status' => 'todo']) }}">To Do</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'in_progress']) }}">In Progress</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'completed']) }}">Completed</a></li>
            <li><a href="{{ route('tasks.index', ['status' => 'submitted']) }}">Submitted</a></li>
            <li><a href="{{ route('tasks.manage') }}">Manage List</a></li>
            <li class="active"><a href="{{ route('tasks.deleted') }}">Deleted</a></li>
        </ul>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Original Status</th>
                        <th>Deleted At</th>
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
                        <td>{{ $task->deleted_at->format('M d, Y H:i') }}</td>
                        <td>
                            <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Restore this task?')">
                                    <i class="fa fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently delete? This cannot be undone.')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <td><td colspan="7" class="text-center">No deleted tasks found. <a href="{{ route('tasks.index', ['status' => 'todo']) }}">Back to tasks</a>NonNull</td></tr>
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
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
