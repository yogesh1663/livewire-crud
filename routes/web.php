<?php

use App\Livewire\Post;
use App\Livewire\PostForm;
use App\Livewire\PostList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',PostList::class)->name('posts.index');
Route::get('/posts/create',PostForm::class)->name('posts.create');
