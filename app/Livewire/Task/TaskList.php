<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Tasks List')]
class TaskList extends Component
{
    public function render()
    {
        $tasks = Task::all();
        return view('livewire.task.task-list', compact('tasks'));
    }
}
