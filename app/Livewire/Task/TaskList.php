<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

#[Title('Tasks List')]
class TaskList extends Component
{
    public $search = '';
    public $statusFilter = '';
    public $sortOrder = 'desc';

    public $tasks = [];

    public function updatedSearch($value)
    {
        $this->reset('tasks');
        if ($value === '') {
            $this->getTasks();
        } else {
            $searchTerm = "%{$value}%";
            $this->tasks = Task::where('title', 'LIKE', $searchTerm)->orWhere('description', 'like', '%' . $this->search . '%')->get();
        }
    }

    public function updatedstatusFilter($value)
    {
        $this->reset('tasks');
        if ($value === '') {
            $this->getTasks();
        } else {
            $this->tasks = Task::where('is_completed', $value)->get();
        }
    }

    public function updatedsortOrder($value)
    {
        $this->reset('tasks');
        if ($value === '') {
            $this->getTasks();
        } else {
            $this->tasks = Task::orderBy('created_at', $value)->get();
        }
    }

    public function boot()
    {
        $this->getTasks();
    }

    #[On('refresh-task-list')]
    public function getTasks()
    {
        $this->tasks = Task::orderBy('created_at', $this->sortOrder)->get();
    }

    public function markAsComplete(Task $task)
    {
        $task->update([
            'is_completed' => true,
        ]);
        $this->getTasks();
        session()->flash('success', 'Task completed successfully.');
    }

    public function delete(Task $task)
    {
        try {
            $task->delete();
            $this->getTasks();
            session()->flash('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Task deletion failed: ' . $e->getMessage());
            session()->flash('error', 'Error deleting task.');
        }
    }

    #[On('task-updated')]
    public function updateTask()
    {
        session()->flash('success', 'Task updated successfully.');
    }

    #[On('task-created')]
    public function createTask()
    {
        session()->flash('success', 'Task created successfully.');
    }


    public function render()
    {
        return view('livewire.task.task-list');
    }
}
