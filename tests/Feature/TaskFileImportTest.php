<?php

use App\Livewire\Task\ImportTasksForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('imports a valid task CSV file', function () {
    Storage::fake('local');

    $file = UploadedFile::fake()->createWithContent('tasks.csv', "title,description\nTest Task,Description");

    Livewire::test(ImportTasksForm::class)
        ->set('file', $file)
        ->call('import')
        ->assertHasNoErrors();

    expect(\App\Models\Task::where('title', 'Test Task')->exists())->toBeTrue();
});

it('shows error for invalid file type', function () {
    $file = UploadedFile::fake()->create('invalid.pdf', 100);

    Livewire::test(ImportTasksForm::class)
        ->set('file', $file)
        ->call('import')
        ->assertHasErrors(['file' => 'mimes']);
});

it('shows error for empty file', function () {
    $file = UploadedFile::fake()->createWithContent('empty.csv', '');

    Livewire::test(ImportTasksForm::class)
        ->set('file', $file)
        ->call('import')
        ->assertHasErrors();
});
