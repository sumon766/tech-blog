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
            <form action="{{ route('posts.filter') }}" method="GET" class="mb-3">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-2 heading-mt">
                        <h6>Filter posts by date</h6>
                    </div>
                    <div class="col-md-4">
                        <label for="startDate" class="form-label">Start date</label>
                        <input class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="col-md-4">
                        <label for="endDate" class="form-label">End date</label>
                        <input class="form-control" id="endDate" name="endDate">
                    </div>

                    <div class="col-md-2 button-mt">
                        <button type="submit" class="btn btn-primary btn-sm">Apply filter</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">Reset</a>
                    </div>
                </div>
            </form>

            @if($posts->isEmpty())
                <div class="col">
                    <h3 class="text-center">You have no post to display.</h3>
                </div>
            @else
                <div class="col-md-12 mt-3">
                    <table class="table table-striped posts-table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
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
                                <td>
                                    @if($post->status === 0)
                                        <form class="status-update-form" action="{{ route('updateStatus', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary btn-sm">Activate</button>
                                        </form>
                                    @else
                                        <form class="status-update-form" action="{{ route('updateStatus', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-primary btn-sm">Deactivate</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $post->id }}">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="deleteModal-{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $post->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Are you sure, you want to delete this post?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirm delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
