@extends('layouts.master')

@section('title', 'Edit Task')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fa fa-pencil-square-o"></i> Edit Task</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Task Name <span class="text-danger">*</span></label>
                <input type="text" name="task_name" class="form-control" value="{{ old('task_name', $task->task_name) }}">
                @error('task_name')
                    <div class="alert alert-danger" style="margin-top: 5px; padding: 5px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger" style="margin-top: 5px; padding: 5px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Priority <span class="text-danger">*</span></label>
                        <select name="priority" class="form-control">
                            <option value="Urgent and Important" {{ old('priority', $task->priority) == 'Urgent and Important' ? 'selected' : '' }}>Urgent and Important</option>
                            <option value="Important but Not Urgent" {{ old('priority', $task->priority) == 'Important but Not Urgent' ? 'selected' : '' }}>Important but Not Urgent</option>
                            <option value="Urgent but Not Important" {{ old('priority', $task->priority) == 'Urgent but Not Important' ? 'selected' : '' }}>Urgent but Not Important</option>
                            <option value="Not Urgent or Important" {{ old('priority', $task->priority) == 'Not Urgent or Important' ? 'selected' : '' }}>Not Urgent or Important</option>
                        </select>
                        @error('priority')
                            <div class="alert alert-danger" style="margin-top: 5px; padding: 5px 10px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Deadline <span class="text-danger">*</span></label>
                        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $task->deadline->format('Y-m-d')) }}">
                        @error('deadline')
                            <div class="alert alert-danger" style="margin-top: 5px; padding: 5px 10px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="todo" {{ old('status', $task->status) == 'todo' ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="submitted" {{ old('status', $task->status) == 'submitted' ? 'selected' : '' }}>Submitted</option>
                </select>
                @error('status')
                    <div class="alert alert-danger" style="margin-top: 5px; padding: 5px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Update Task</button>
                <a href="{{ route('tasks.index', ['status' => 'todo']) }}" class="btn btn-default">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
