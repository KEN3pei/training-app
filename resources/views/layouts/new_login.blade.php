<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- style.css -->
	<link rel="stylesheet" href="css/new_login.css">
	<!-- font Awesome -->  
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">  
    
	<title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a href="#" class="navbar-brand">Every Training</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsivenuno">
		        <span class="navbar-toggler-icon"></span>
        	</button>	
        	
            <div class="collapse navbar-collapse" id="responsivenuno">
                <ul class="navbar-nav ml-auto">
                    <!--//ここからlogoutする-->
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
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
      @yield('content')
      
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>