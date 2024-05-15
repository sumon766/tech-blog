<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row justify-content-center mt-4">
            <div class="col-md-5 mt-4">
                <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary">Create New Post</a>
                <a href="{{ route('posts.index') }}" class="btn btn-lg btn-primary ms-5">See All Posts</a>
            </div>
        </div>
    </div>
</x-app-layout>
