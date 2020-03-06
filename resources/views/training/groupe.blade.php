@extends('layouts.groupe')

@section('content')
<div class="container">
    <div>
        <div>
            <h1>Listの新規作成</h1>
            <form action="{{ action('GroupeController@create')}}" method="post" enctype="multipart/form-data">
                <input type="text" name="list_name">
                <input type="submit" value="Submit">
                @csrf
            </form>
        </div>
        <div>
            <h1>Membarの追加/検索</h1>
            <form action="{{ action('GroupeController@search') }}" method="post" enctype="multipart/form-data">
                <input type="text" name="list_membar">
                <input type="submit" value="Submit">
                @csrf
            </form>
        </div>
        <div>
            <!--if、groupeがnullではなければ表示する-->
            <!--nullなら違うものを表示する-->
            <ul>
                @if(isset($user_all))
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
                            @foreach($lists as $list)
                                <li><a href="{{ action('GroupeController@add_groupe', ['list_id' => $list->id])}}">
                                    {{ $list->list_name }}に追加</a></li>
                            @endforeach
                      </ul>
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        <div>
            <h1>List一覧</h1>
            <ul>
                <li>
                    <p class="membar_name">Listname</p>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default">Default</button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <!--foreachでgroupeのnameを表示する-->
                      <!--各dropdownをクリックしたらそこのgroupe_nameのgroupe_mambarに追加される-->
                      <ul class="dropdown-menu">
                        <li><a href="#">List1に追加</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">List4に追加</a></li>
                      </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>



@endsection

