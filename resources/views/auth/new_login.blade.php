@extends('layouts.new_login')

@section('content')

<div class="login">
  <div class="heading">
    <h2>Sign in</h2>
    <form method="POST" action="{{ route('login') }}">
    @csrf
      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email-addres" required autocomplete="email" autofocus>
        
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="input-group input-group-lg">
        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
        
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
        <!-- <p class="mt-3 text-secondary">他のアカウントでログインする</p> -->
        <div class="mt-4">
            <!-- <a href="#" class="btn btn-danger" role="button">
                <i class="fab fa-google"></i>
                Google
            </a>
            <a href="#" class="btn btn-primary" role="button">
                <i class="fab fa-twitter"></i>
                twitter
            </a> -->
        </div>
        <div>
        <button type="submit" class="float">Login</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        </div>  
       </form>
 		</div>
 </div>

@endsection
