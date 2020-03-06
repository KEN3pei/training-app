@extends('layouts.training')

@section('content')

<div class="container mt-5">
    <div class="image-box edit-image-box">
    @if(!$image == null)
        <img class="img-item" src="{{ $image }}">    
    @endif
    </div>
    <form action="{{ action('TrainingController@edit') }}" method="post" enctype="multipart/form-data">
        <!--//enctype="multipart/form-data"がないとcontrollerでfileメソッドで取り出せない//-->
        <input type="file" class="form-control-file" name="image">
        <input type="submit" value="更新">
        {{ csrf_field() }}
    </form>
    <h4>{{ $auth->name }}</h4>
    <div>
        <form action="{{ action('TrainingController@delete', ['user_id' => $auth->id]) }}" method="post" enctype="multipart/form-data">
            <p></p>
            <input type="submit" value="削除">
            @csrf
        </form>
    </div>
</div>

@endsection