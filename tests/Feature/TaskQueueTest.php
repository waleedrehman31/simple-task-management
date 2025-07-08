<?php

use App\Jobs\NotifyTaskComplete;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;

uses(RefreshDatabase::class);

it('dispatches NotifyTaskComplete job to the queue', function () {
    Queue::fake();

    $task = Task::create([
        'title' => 'Queued Task',
        'description' => 'Handled via job',
    ]);

    NotifyTaskComplete::dispatch($task);

    Queue::assertPushed(NotifyTaskComplete::class, function ($job) use ($task) {
        return $job->task->is($task);
    });
});

it('executes NotifyTaskComplete job and logs task info', function () {
    Log::shouldReceive('info')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, 'Task #');
        });

    $task = Task::create([
        'title' => 'Job Execution Task',
        'description' => 'Testing job handle',
        'is_completed' => true,
        'completed_at' => now(),
    ]);

    (new NotifyTaskComplete($task))->handle();
});
