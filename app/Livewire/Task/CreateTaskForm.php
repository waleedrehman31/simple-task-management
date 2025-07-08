<?php

namespace App\Livewire\Task;

use App\Models\Tag;
use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\Validate;

class CreateTaskForm extends Component
{
    #[Validate('required|string')]
    public $title;

    #[Validate('nullable|string')]
    public $description;

    #[Validate('array')]
    public $selectedTags = [];

    public function save()
    {
        $this->validate();

        $task = Task::create($this->all());

        if (!empty($this->selectedTags)) {
            $task->tags()->attach($this->selectedTags);
        }

        $this->reset('title', 'description', 'selectedTags');

        $this->dispatch('refresh-task-list');
    }

    public function render()
    {
        return view('livewire.task.create-task-form', [
            'tags' => Tag::all(),
        ]);
    }
}
