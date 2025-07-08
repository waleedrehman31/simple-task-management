<?php

namespace App\Imports;

use App\Models\Tag;
use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TasksImport implements ToModel, WithHeadingRow
{
    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            if (empty($row) || ! isset($row['title']) || empty($row['title'])) {
                throw new \Exception('Missing required title in row.');
            }
            $task = Task::create([
                'title' => $row['title'],
                'description' => $row['description'] ?? null,
                'is_completed' => isset($row['is_completed']) && $row['is_completed'] == 1,
            ]);

            if (isset($row['tags'])) {
                $tags = collect(explode(',', $row['tags']))
                    ->map(fn ($tag) => trim($tag))
                    ->filter()
                    ->unique();

                foreach ($tags as $tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $task->tags()->attach($tag->id);
                }
            }

            return $task;
        } catch (\Exception $e) {
            \Log->error('Task import error: '.$e->getMessage());

            return null;
        }
    }
}
