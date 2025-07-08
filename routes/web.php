<?php

use App\Livewire\Task\TaskList;
use Illuminate\Support\Facades\Route;

Route::get('/', TaskList::class);
