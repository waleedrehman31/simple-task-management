<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyTaskComplete implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public Task $task;

    /**
     * Create a new job instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Simulate the email sending
        sleep(5);
        if ($this->task) {
            Log::info("Task #{$this->task->id} marked as completed by job at ".$this->task->completed_at);
        }
    }
}
