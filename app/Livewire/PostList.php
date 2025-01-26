<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.post-list',[
            'posts' => Post::paginate(5),
        ]);
    }
}
