<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';

    public $searchList = null;

    public function handleDelete(Post $post){

        if($post){
            if(Storage::disk('public')->exists($post->featured_image)){
                Storage::disk('public')->delete($post->featured_image);
            }
            $query = $post->delete();
            if($query){
                flash()->success('post deleted successfully!');
            }
        }
    }
    public function render()
    {
        return view('livewire.post-list',[
            'posts' => Post::where('title','like','%'.$this->searchList.'%')
            ->orWhere('content','like','%'.$this->searchList.'%')
            ->paginate(5)
        ]);
    }
}
