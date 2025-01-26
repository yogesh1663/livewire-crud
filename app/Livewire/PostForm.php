<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class PostForm extends Component
{
    use WithFileUploads;


    public $isView = false;
    public $post = null;
    public $title = '';
    public $content = '';
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
        $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'featured_image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $imagePath = null;
        if($this->featured_image){

            if ($this->post && $this->post->featured_image && Storage::disk('public')->exists($this->post->featured_image)) {
                Storage::disk('public')->delete($this->post->featured_image);
            }
            $imageName = time().'.'.$this->featured_image->extension();
            $imagePath = $this->featured_image->storeAs('featured_images',$imageName,'public');
        }
       if($this->post){
            $this->post->title = $this->title;
            $this->post->content = $this->content;
            $this->post->featured_image = $imagePath;
            $query = $this->post->save();
            if($query){
                flash()->success('post updated successfully!');
                return $this->redirect('/posts',navigate:true);
            }
       }
       else{
            $post = new Post();
            $post->title = $this->title;
            $post->content = $this->content;
            $post->featured_image = $imagePath;
            $query = $post->save();
            if($query){
                flash()->success('post created successfully!');
                return $this->redirect('/posts',navigate:true);
            }
       }
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
