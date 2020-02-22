@extends('layouts.app')

@section('content')


<form action="{{ action('TrainingController@tweet') }}" method="post" enctype="multipart/form-data">
      <div>
          <textarea name="body" rows="10" maxlength='50'>{{ old('body') }}</textarea>
      </div>
      <input type="submit" value="Submit">
{{ csrf_field() }}
</form>

<div>
    {{ var_dump($update_days) }}
</div>

@foreach($posts as $tweet)
    @if ($auth->id == $tweet->user_id)
    <ul>
        <li>ユーザ名　{{ $auth->name }}</li>
        <li>{{ $tweet->name }}</li>
        <li>{{ $tweet->body }}</li>
        <li>{{ \Str::limit($tweet->updated_at, 7) }}</li>
    </ul>
    @endif
@endforeach

    
@endsection