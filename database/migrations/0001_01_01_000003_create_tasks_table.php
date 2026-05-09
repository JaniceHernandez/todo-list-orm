<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(){
        Schema::create('tasks', function (Blueprint $table){
            $table->id();
            $table->string('task_name');
            $table->text('description')->nullable();
            $table->enum('priority', [
                'Urgent and Important',
                'Important but Not Urgent',
                'Urgent but Not Important',
                'Not Urgent or Important'
            ]);
            $table->date('deadline');
            $table->enum('status', [
                'todo',
                'in_progress',
                'completed',
                'submitted'])->default('todo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('tasks');
    }
};
