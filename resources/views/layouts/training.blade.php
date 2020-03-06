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
    <!--fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<link href="{{ asset('css/style.css') }}" rel="stylesheet" >
	<link href="{{ asset('css/fixed.css') }}" rel="stylesheet" >
	<!--<link href="{{ asset('css/calendar.css') }}" rel="stylesheet" >-->
	
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
                    <!--//ここからlogoutする-->
                    @guest
                        <!--<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>-->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item"><a href="/profile" class="nav-link">myprofile</a></li>
                        <li class="nav-item"><a href="" class="nav-link"
                        onclick="event.preventDefault();
                        document. getElementById('logout-form').submit();">Logout</a>
                        <!--preventDefaulはonclickのデフォルト動作を妨害する-->
                        <!--logout-form IDを取得するgetelement~ -->
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
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
                <a href="{{ url('/') }}"><i class="fas fa-home"></i>
                <p>ホーム</p></p></a>
                </div>
            </div>
            <div class="col-4">
                <div class="container text-center">
                <a href="{{ url('/groupe') }}"><i class="fas fa-list"></i>
                <p>リスト</p></a>
                </div>
            </div>
            <div class="col-4">
                <div class="container text-center">
                <a href="{{ url('/calendar') }}"><i class="far fa-calendar-alt"></i>
                <p>カレンダー</p></a>
                </div>
            </div>
        </div>
        </footer>
    </div>
    <script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>
</body>
</html>
