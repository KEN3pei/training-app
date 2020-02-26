@extends('layouts.training')

@section('content')
<div class="container mt-5">
      
<!--ログインした時点で$tweetの情報が使える-->
<form action="{{ action('TrainingController@tweet', ['id' => $tweet->id] )}}" method="post" enctype="multipart/form-data">
      <div>
          <textarea name="body" rows="10" maxlength='50'>{{ old('body') }}</textarea>
      </div>
      <input type="submit" value="Submit">
      {{ csrf_field() }}
</form>

<div>{{ $tweet->body }}</div>

@if(session('status'))
      <div class="alert alert-success">
            {{ session('status') }}
      </div>
@endif
<!--この下に全員のbodyを表示したい-->
      
</div>

    
@endsection