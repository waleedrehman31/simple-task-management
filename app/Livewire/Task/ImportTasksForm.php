<?php

namespace App\Livewire\Task;

use App\Imports\TasksImport;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportTasksForm extends Component
{
    use WithFileUploads;

    #[Validate('required|file|mimes:csv,xlsx,xls')]
    public $file;

    public $successMessage = '';

    public $errorMessage = '';

    public function import()
    {
        $this->validate();
        try {
            Excel::import(new TasksImport, $this->file->getRealPath());
            $this->successMessage = 'Tasks imported successfully!';
            $this->dispatch('refresh-task-list');
            $this->reset('file');
        } catch (\Exception $e) {
            logger()->error('Task import error: '.$e->getMessage());
            $this->errorMessage = 'Failed to import tasks. Please check your file format.';
        }
    }

    public function render()
    {
        return view('livewire.task.import-tasks-form');
    }
}
