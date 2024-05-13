<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of your posts') }}
        </h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Create a post</a>
    </x-slot>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <button type="button" class="btn-close flash-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center page-content">
            @if($posts->isEmpty())
                <h3 class="text-center">You have not created any post yet.</h3>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Deleted at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>{{ $post->deleted_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Activate</button>
                                <button class="btn btn-primary btn-sm">Deactivate</button>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
