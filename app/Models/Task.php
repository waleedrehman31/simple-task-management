<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_completed', 'completed_at', 'start_date', 'end_date'];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getStatusAttribute(): string
    {
        return $this->is_completed ? 'Completed' : 'In Complete';
    }

    public function getStartDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function setStartDateAttribute($value)
    {
        $this->start_date = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function getEndDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function setEndDateAttribute($value)
    {
        $this->end_date = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }
}
