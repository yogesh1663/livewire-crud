<?php

use App\Livewire\Post;
use App\Livewire\PostList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',PostList::class)->name('posts.index');
