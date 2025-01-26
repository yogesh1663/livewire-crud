<div class="container" style="max-width: 900px">
    <div class="border-black d-flex justify-content-between align-items-center border-bottom">
        <h2>Posts</h2>
        <a href="" class="btn btn-sm btn-secondary">Back</a>
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
                <td>{{$post->title}}</td>
                <td>{{asset($post->featured_image)}}</td>
                <td>{{$post->content}}</td>
                <td>Edit|Delete</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No data found</td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>