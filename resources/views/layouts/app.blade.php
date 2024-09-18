<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
   <!-- CSS -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>
        .navbar-nav .nav-link.active{
            color: blue !important;
            font-weight: bold;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Propelrr</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('fibonacci.*') ? 'active' : '' }}" href="{{route('fibonacci.index')}}">Fibonacci</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('exam.*') ? 'active' : '' }}" href="{{route('exam.sort.index')}}">Class</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('form.*') ? 'active' : '' }}" href="{{route('form.index')}}">Form</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
