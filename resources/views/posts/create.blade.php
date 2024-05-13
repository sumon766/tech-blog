<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new post') }}
        </h2>
        <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm">See your posts</a>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center page-content">
            <div class="col-8">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Description</label>
                        <textarea class="form-control" name="body" id="body" rows="5" required></textarea>
                        @error('body')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" name="status" type="checkbox" value="1" id="status" checked>
                        <label class="form-check-label" for="status">
                            Post activation
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm mt-3">Create post</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
