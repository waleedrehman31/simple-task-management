<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

#[Title('Tasks List')]
class TaskList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $statusFilter = '';
    public $sortOrder = 'desc';

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedstatusFilter()
    {
        $this->resetPage();
    }
    public function updatedsortOrder()
    {
        $this->resetPage();
    }


    public function markAsComplete(Task $task)
    {
        try {
            $task->update([
                'is_completed' => true,
            ]);
            session()->flash('success', 'Task completed successfully.');
        } catch (\Exception $e) {
            Log::error('Task completion failed: ' . $e->getMessage());
            session()->flash('error', 'Error completing task.');
        }
    }

    public function delete(Task $task)
    {
        try {
            $task->delete();
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

    public function getTasksProperty()
    {
        $query = Task::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->statusFilter !== '') {
            $query->where('is_completed', $this->statusFilter);
        }

        $query->orderBy('created_at', $this->sortOrder);

        return $query->paginate(12);
    }

    #[On('refresh-task-list')]
    public function render()
    {
        return view('livewire.task.task-list', [
            'tasks' => $this->tasks,
        ]);
    }
}
