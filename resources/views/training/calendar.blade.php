@extends('layouts.training')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="full-height">
            <div class="content">
                <a href="?ym={{ $prev }}">&lt;</a>
                <span class="month">{{ $month }}</span>
                <a href="?ym={{ $next }}">&gt;</a>
            </div>
            <div>
            <table class="table">
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                    
                </tr>
                @foreach($weeks as $week)
                    {!! $week !!}
                @endforeach
            </table>
            <div>
                <h5>当日の投稿</h5>
            </div>
            <div class="text-center">
                @if(session('status'))
                    <div class="alert alert-success">
                    <!--<div>-->
                    {{ session('status') }}
                    </div>
                @else
                    <div class="alert alert-success">
                    <!--{{ $body }}-->
                    {{ session('status') }}
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
    <!--<div class="text-center">-->
    <!--    @if(session('status'))-->
    <!--        <div class="alert alert-success">-->
            <!--<div>-->
    <!--        {{ session('status') }}-->
    <!--        </div>-->
    <!--    @else-->
    <!--        <div class="alert alert-success">-->
    <!--        {{ $body }}-->
    <!--        </div>-->
    <!--    @endif-->
    <!--</div>-->
</div>

    
@endsection