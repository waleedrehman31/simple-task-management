<?php

namespace App\Livewire\Task;

use App\Models\Tag;
use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class EditTaskModel extends Component
{
    public $taskId;

    #[Validate('required|string')]
    public $title;

    #[Validate('string')]
    public $description;

    #[Validate('array')]
    public $selectedTags = [];

    public function setTask($id)
    {
        $task = Task::with('tags')->findOrFail($id);

        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->selectedTags = $task->tags->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();
        try {
            $task = Task::findOrFail($this->taskId);
            $task->update($this->all());

            $task->tags()->sync($this->selectedTags);

            $this->dispatch('task-updated');
            $this->dispatch('refresh-task-list');
        } catch (\Exception $e) {
            Log::error('Task updating failed: ' . $e->getMessage());
            session()->flash('error', 'Error updating task.');
        }
    }


    public function render()
    {
        return view('livewire.task.edit-task-model', [
            'tags' => Tag::all(),
        ]);
    }
}
