<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates a task successfully', function () {
    $task = Task::create([
        'title' => 'Task Test',
        'description' => 'Test description',
        'is_completed' => false,
    ]);

    expect($task)->toBeInstanceOf(Task::class)
        ->and($task->title)->toBe('Task Test')
        ->and($task->is_completed)->toBeFalse();
});

it('marks a task as complete', function () {
    $task = Task::factory()->create();

    $task->update(['is_completed' => true]);

    expect($task->fresh()->is_completed)->toBe(1);
});

it('deletes a task successfully', function () {
    $task = Task::factory()->create();

    $task->delete();

    expect(Task::find($task->id))->toBeNull();
});

it('fails to create task without title', function () {
    expect(function () {
        Task::create(['description' => 'Missing title']);
    })->toThrow(\Illuminate\Database\QueryException::class);
});
