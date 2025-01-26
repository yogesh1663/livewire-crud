<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
{
    use WithFileUploads;
    // validation rules for title

    public $isView = false;
    public $post;
    #[Validate('required',message:'Post Title is required.')]
    #[Validate('min:3',message:'Post Title should be at least 3 Character.')]
    #[Validate('unique:posts',message:'Post Title is already taken.')]
    public $title = '';

    // validation rules for content
    #[Validate('required',message:'Post Description is required.')]
    #[Validate('min:3',message:'Post Description should be at least 3 Character.')]
    public $content = '';

    // validation rules for featured image
    #[Validate('required',message:'Featured image is required.')]
    #[Validate('image',message:'Featured image must be a valid image.')]
    #[Validate('mimes:jpg,jpeg,gif,png',message:'Featured image must be of type jpg, jpeg, gif or png.')]
    #[Validate('max:2048',message:'Featured image must not be larger then 2Mb.')]
    public $featured_image = null;

    public function mount(Post $post){
        $this->isView = request()->routeIs('posts.view');
        if($post->id){
            $this->post = $post; //for image
            // dd($post->featured_image);
            $this->title = $post->title;
            $this->content = $post->content;
        }

    }

    //function to save post
    public function savePost(){
        $this->validate();
        $imagePath = null;
       if($this->featured_image){
        $imageName = time().'.'.$this->featured_image->extension();
        $imagePath = $this->featured_image->storeAs('featured_images',$imageName,'public');
       }
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->featured_image = $imagePath;
        $query = $post->save();
        if($query){
            return redirect()->route('posts.index');
        }
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
