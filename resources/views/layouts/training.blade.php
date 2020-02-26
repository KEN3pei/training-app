<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<link href="{{ asset('css/style.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/fixed.css') }}" rel="stylesheet" >
	
</head>
<body data-spy="scroll" data-target="#responsivenuno">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a href="#" class="navbar-brand">Every Training</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenuno">
		        <span class="navbar-toggler-icon"></span>
        	</button>	
            <div class="collapse navbar-collapse" id="responsivenuno">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="#" class="nav-link">myprofile</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">logout</a></li>
                </ul>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>
        
        <footer class="fixed-bottom bg-dark">
        <div class="row fooer-content">
            <div class="col-4">
                <div class="container text-center">
                <a href="{{ url('/') }}">home</a>
                </div>
            </div>
            <div class="col-4">
                <div class="container text-center">
                <a href="">list</a>
                </div>
            </div>
            <div class="col-4">
                <div class="container text-center">
                <a href="{{ url('/calendar') }}">calendar</a>
                </div>
            </div>
        </div>
        </footer>
    </div>
    <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
</body>
</html>
