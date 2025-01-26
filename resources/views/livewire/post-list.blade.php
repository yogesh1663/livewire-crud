<div class="container" style="max-width: 900px">
    <div class="border-black d-flex justify-content-between align-items-center border-bottom">
        <h2>Posts</h2>
        <a href="{{route('posts.create')}}" class="btn btn-sm btn-success" wire:navigate>Create Post</a>
    </div>
    <div class="mt-2 row d-flex justify-content-end">
        <div class="col-lg-6">
            <input type="text" name="search" id="input-id" class="form-control" placeholder="Search"
                wire:model.live='searchList'>
        </div>
    </div>

    <table class="table mt-2 table-bordered border-primary">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Featured Image</th>
                <th scope="col">Content</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
            <tr wire:key='{{$post->id}}'>
                <th scope="row">{{$loop->iteration}}</th>
                <td><a href="{{route('posts.view',$post->id)}}">{{$post->title}}</a></td>
                <td><a href="{{route('posts.view',$post->id)}}"><img
                            src="{{ asset('storage/featured_images/' . basename($post->featured_image)) }}" alt="image"
                            class="imageimg-thumbnail" style="width: 50px; height:50px"></a></td>
                <td>{{$post->content}}</td>
                <td>
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-sm btn-outline-success"
                        wire:navigate>Edit</a>
                    <button class="btn btn-sm btn-outline-danger" wire:confirm='Are you sure you want to delete it ?'
                        wire:click='handleDelete({{$post->id}})'>Delete</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{$posts->links()}}
</div>
