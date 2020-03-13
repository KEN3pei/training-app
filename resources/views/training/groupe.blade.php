@extends('layouts.training')

@section('content')
<div class="container mt-5">
    <div class="list_contents text-center">
        <div>
            <h2>Listの新規作成</h2>
            <form action="{{ action('GroupeController@create')}}" method="post" enctype="multipart/form-data">
                <input id="list_box" type="text" name="list_name">
                <input type="submit" value="Submit">
                @csrf
            </form>
        </div>
        <div>
            <h2>Membarの追加/検索</h2>
            <form action="{{ action('GroupeController@search') }}" method="post" enctype="multipart/form-data">
                <input id="list_box" type="text" name="list_membar">
                <input type="submit" value="Submit">
                @csrf
            </form>
        </div>
        <div>
            <!--if、groupeがnullではなければ表示する-->
            <!--nullなら違うものを表示する-->
            <ul>
                 @foreach($user_all as $user)
                <li>
                    <img src="{{ $user->image }}" class="groupe-img"></img>
                    <p class="membar_name">{{ $user->name }}</p>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Default</button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <!--foreachでgroupeのnameを表示する-->
                      <!--各dropdownをクリックしたらそこのgroupe_nameのgroupe_mambarに追加される-->
                      <ul class="dropdown-menu">
                            @foreach($list_names as $list)
                                <li><a href="{{ action('GroupeController@add_groupe', ['user_id' => $user->id, 'groupe_id' => $list->id])}}">
                                    {{ $list->list_name }}に追加</a></li>
                            @endforeach
                      </ul>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        
        
        <div>
            <h2>List一覧</h2>
            <ul>
                @foreach($list_names as $list)
                <li>
                    <p class="membar_name">{{ $list->list_name }}</p>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">membars</button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <!--foreachでgroupeのnameを表示する-->
                      <!--各dropdownをクリックしたらそこのgroupe_nameのgroupe_mambarに追加される-->
                      <ul class="dropdown-menu">
                            @foreach($list->membar_get as $membar)
                            <li><a href="#">{{ $membar->user_id }}</a></li>
                            @endforeach
                      </ul>
                      
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>



@endsection

