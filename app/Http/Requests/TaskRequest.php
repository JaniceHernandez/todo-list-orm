<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_name'   => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'priority'    => ['required', 'in:Urgent and Important,Important but Not Urgent,Urgent but Not Important,Not Urgent or Important'],
            'deadline'    => ['required', 'date'],
            'status'      => ['required', 'in:todo,in_progress,completed,submitted'],
        ];
    }

    public function messages()
    {
        return [
            'task_name.required' => 'Give it a task name.',
            'priority.required' => 'Please select a priority level.',
            'deadline.required' => 'Set a deadline.',
            'status.required' => 'Please select a status.',
        ];
    }
}
