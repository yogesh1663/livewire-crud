<div class="container" style="max-width: 900px">
    <div class="border-black d-flex justify-content-between align-items-center border-bottom">
        <h2>{{$isView?'View':'Create'}} Post</h2>
        <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary">Back</a>
    </div>
    <div class="p-3 mt-3 border border-black rounded">
        <form wire:submit.prevent='savePost'>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter Post Title" name="title"
                    wire:model='title' {{$isView?'disabled':''}}>
                @error('title')
                <p class="mt-2 text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Post Description</label>
                <textarea class="form-control" id="content" rows="3" placeholder="Enter Post Content"
                    wire:model='content' {{$isView?'disabled':''}}></textarea>
                @error('content')
                <p class="mt-2 text-danger">{{$message}}</p>
                @enderror
            </div>
            @if(!$isView)
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                <input class="form-control" type="file" id="featured_image" wire:model='featured_image'>
                @if ($featured_image)
                <div class="p-2 mt-3 border border-black d-flex justify-content-center align-items-center">
                    <img src="{{ $featured_image->temporaryUrl() }}" class="img-thumbnail"
                        style="height: 200px; object-fit: cover;">
                </div>
                @endif
                @error('featured_image')
                <p class="mt-2 text-danger">{{$message}}</p>
                @enderror
            </div>
            @else
            <div class="mb-3">
                <label for="featured_image" class="form-label">Featured Image</label>
                @if ($post->featured_image)
                <div class="p-2 mt-3 border border-black d-flex justify-content-center align-items-center">
                    <img src="{{ Storage::url($post->featured_image) }}" class="img-thumbnail"
                        style="height: 200px; object-fit: cover;">
                </div>
                @else
                <p class="text-danger">No image Found</p>
                @endif
                @error('featured_image')
                <p class="mt-2 text-danger">{{$message}}</p>
                @enderror
            </div>
            @endif
            @if (!$isView)
            <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        </form>
    </div>

</div>