<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'task_name',
        'description',
        'priority',
        'deadline',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
        'deleted_at' => 'datetime',
    ];
}
