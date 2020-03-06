@extends('layouts.training')

@section('content')
<div class="container mt-5">
      
<div>
      <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                  <a href="#item1" id="item1-tab" data-toggle="tab" class="nav-link active" role="tab" aria-controls="item1" aria-selected="true">今日</a>
            </li>
            <li class="nav-item">
                  <a href="#item2" id="item2-tab" data-toggle="tab" role="tab" class="nav-link" aria-controls="item2" aria-selected="false">昨日</a>
            </li>
            <li class="nav-item">
                  <a href="#item3" id="item3-tab" data-toggle="tab" role="tab" class="nav-link" aria-controls="item3" aria-selected="false">おととい</a>
            </li>
            <li class="nav-item">
                  <a href="#item4" id="item4-tab" data-toggle="tab" role="tab" class="nav-link" aria-controls="item4" aria-selected="false">３日前</a>
            </li>
      </ul>
      <div class="tab-content">
            <div class="tab-pane fade show active" id="item1" role="tabpanel" alia-labelledby="item1-tab">
                  <div class="row">
                  　　<div class="image-box col-md-2">
                      　　@if(!$image == null)
                          　　<img class="img-item" src="{{ $image }}">  
                      　　@endif
                      　　<h4>{{ $auth->name }}</h4>
                  　　</div>
                      <p class="tab-item-1 col-md-2">{{ $tweet->body }}</p>
                      <!--<input type="text" name="body" id="tweet-form" class="tweet-area mt-1 col-md-6" value="{{ old('body') }}">-->
                  </div>          
            </div>
            <div class="tab-pane fade" id="item2" role="tabpanel" alia-labelledby="item2-tab">
                  <div class="row">
                        <div class="image-box col-md-2">
                            @if(!$image == null)
                                <img class="img-item" src="{{ $image }}">    
                            @endif
                            <h4>{{ $auth->name }}</h4>
                        </div>
                        <p class="tab-item-1 col-md-2">{{ $y_day }}</p>
                  </div>  
            </div>
            <div class="tab-pane fade" id="item3" role="tabpanel" alia-labelledby="item3-tab">
                  <p>{{ $two_day }}</p></div>
            <div class="tab-pane fade" id="item4" role="tabpanel" alia-labelledby="item4-tab">
                  <p>{{ $three_day }}</p></div>
      </div>
</div>
      
<!--ログインした時点で$tweetの情報が使える-->
<form action="{{ action('TrainingController@tweet', ['id' => $tweet->id] )}}" method="post" enctype="multipart/form-data">
      <div>
          <input type="text" name="body" class="tweet-area mt-1" value="{{ old('body') }}">
      </div>
      <input type="submit" value="Submit" class="sub-btn">
      {{ csrf_field() }}
</form>

@if(session('status'))
      <div class="alert alert-success">
            {{ session('status') }}
      </div>
@endif
<!--この下に全員のbodyを表示したい-->
      
</div>

    
@endsection