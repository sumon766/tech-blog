<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <a href="{{ route('posts.create') }}" class="btn btn-lg btn-primary">Create New Post</a>
                <a href="{{ route('posts.index') }}" class="btn btn-lg btn-primary ms-5">See All Posts</a>
            </div>
        </div>
    </div>
</x-app-layout>
