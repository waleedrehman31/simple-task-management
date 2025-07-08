<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory()->count(5)->create();

        Task::factory()
            ->count(20)
            ->create()
            ->each(function ($task) use ($tags) {
                $task->tags()->attach(
                    $tags->random(rand(0, 3))->pluck('id')->toArray()
                );
            });
    }
}
