<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tech Blog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/home-post.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TECH BLOG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if (Route::has('login'))
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <form action="{{ route('home.filter') }}" method="GET" class="mb-3">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="user" class="form-label">Posts by user</label>
                            <select class="form-select" aria-label="Default select example" id="user" name="user">
                                <option selected>Please select</option>
                                @if(!empty($users))
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="startDate" class="form-label">Start date</label>
                            <input class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate" class="form-label">End date</label>
                            <input class="form-control" id="endDate" name="endDate">
                        </div>

                        <div class="col-md-3 button-mt">
                            <button type="submit" class="btn btn-primary btn-sm">Apply filter</button>
                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            @if($posts->isEmpty())
                <h4 class="text-center no-post-notification">No post found, <a href="{{ route('posts.create') }}">create one</a>.</h4>
            @else
                @foreach($posts as $post)
                    <div class="col-md-4 mt-4">
                        <article class="post">
                            <img class="img-thumbnail rounded mx-auto" src="{{ asset($post->image) }}" alt="Post Image">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ substr($post->body, 0, 130) }}...</p>
                            <a class="btn btn-sm btn-primary" href="{{ route('show', $post->id) }}">Read more</a>
                        </article>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',

        maxDate: function () {
            return $('#endDate').val();
        }
    });
    $('#endDate').datepicker({
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        minDate: function () {
            return $('#startDate').val();
        }
    });
</script>
</body>
</html>
