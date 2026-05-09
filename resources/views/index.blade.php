@extends('layouts.master')

@section('title', ucfirst(str_replace('_', ' ', $status)) . ' Tasks')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>
            <i class="fa fa-tasks"></i>
            @if($status == 'todo')
                To Do Tasks
            @elseif($status == 'in_progress')
                In Progress Tasks
            @elseif($status == 'completed')
                Completed Tasks
            @elseif($status == 'submitted')
                Submitted Tasks
            @else
                Tasks
            @endif
        </h3>
        <div class="count-chip" style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 30px;">
            {{ $tasks->total() }} total
        </div>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="{{ $status == 'todo' ? 'active' : '' }}"><a href="{{ route('tasks.index', ['status' => 'todo']) }}">To Do</a></li>
            <li class="{{ $status == 'in_progress' ? 'active' : '' }}"><a href="{{ route('tasks.index', ['status' => 'in_progress']) }}">In Progress</a></li>
            <li class="{{ $status == 'completed' ? 'active' : '' }}"><a href="{{ route('tasks.index', ['status' => 'completed']) }}">Completed</a></li>
            <li class="{{ $status == 'submitted' ? 'active' : '' }}"><a href="{{ route('tasks.index', ['status' => 'submitted']) }}">Submitted</a></li>
            <li><a href="{{ route('tasks.manage') }}">Manage List</a></li>
            <li><a href="{{ route('tasks.deleted') }}">Deleted</a></li>
        </ul>

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
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Move this task to deleted?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <table><td colspan="6" class="text-center">No tasks in this category. <a href="{{ route('tasks.create') }}">Add one</a></td>
                    </tr>
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

<!-- Modal for Description only -->
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: white;">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> <span id="modalTaskName"></span></h4>
            </div>
            <div class="modal-body">
                <label>Description:</label>
                <p id="modalDescription" style="white-space: pre-wrap; margin-top: 10px; line-height: 1.6;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
