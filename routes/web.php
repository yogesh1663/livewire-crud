<?php

use App\Livewire\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',Post::class)->name('posts.index');
