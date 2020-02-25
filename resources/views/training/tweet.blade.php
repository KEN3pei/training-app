@extends('layouts.training')

@section('content')
<div class="container">
      
<!--ログインした時点で$tweetの情報が使える-->
<form action="{{ action('TrainingController@tweet')}}" method="post" enctype="multipart/form-data">
      <div>
          <textarea name="body" rows="10" maxlength='50'>{{ old('body') }}</textarea>
      </div>
      <input type="submit" value="Submit">
      {{ csrf_field() }}
</form>

<div>{{ $tweet->body }}</div>
      
</div>

    
@endsection