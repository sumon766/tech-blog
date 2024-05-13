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

        </div>
    </div>
</x-app-layout>
