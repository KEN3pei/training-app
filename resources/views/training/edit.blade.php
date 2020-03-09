@extends('layouts.training')

@section('content')

<div class="container mt-5">
    <div class="image_section">
        <h3 class="text-center">アカウント編集</h3>
        <div class="row image_row">
            <div class="image-box edit-image-box col-5">
            @if(!$image == null)
                <img class="img-item" src="{{ $image }}">    
            @endif
            </div>
            <div class="col-6 d-flex align-items-center">
            <form action="{{ action('TrainingController@edit') }}" method="post" enctype="multipart/form-data">
                <!--//enctype="multipart/form-data"がないとcontrollerでfileメソッドで取り出せない//-->
                <div class="row">
                <div class="col-10"><input type="file" class="form-control-file" name="image"></div>
                <!--<div class="col-1"></div>-->
                <div class="col-1"><input type="submit" value="更新" class="update_img"></div>
                </div>
                {{ csrf_field() }}
            </form>
            <!--<h4>{{ $auth->name }}</h4>-->
            </div>
        </div> 
        <div class="mt-2">
            <div class="row image_row">
                <div class="col-5">
                    <h3>{{ $auth->name }}</h3>
                </div>
                <div class="col-6 d-flex align-items-center">
                    <form action="{{ action('TrainingController@name_update') }}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-10 input_name"><input type="text" name="name" class="input_name_text"></div>
                            <!--<div class="col-1"></div>-->
                            <div class="col-1 input_name"><input type="submit" value="変更" class="update_img"></div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="image_row">
            <div class="text-right">
                <form action="{{ action('TrainingController@delete', ['user_id' => $auth->id]) }}" method="post" enctype="multipart/form-data">
                    <p>アカウント消去</p>
                    <input type="submit" value="削除">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

@endsection