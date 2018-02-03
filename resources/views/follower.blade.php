@extends('layouts.template')

@section('content')
    <button class="btn btn-link btn-lg btn-block back-btn">
        <span class="glyphicon glyphicon-arrow-left"></span>
        フォロワー
    </button>
    @foreach ($followers as $follower)
    <div class="row list-padding-border">
        <div class="col-xs-3 col-xs-offset-1 list-padding">
            <img src="img/mamoru_face.png" alt="まもる" class="img-circle img-responsive img-icon" />
        </div>
        <div class="col-xs-3 list-padding"><span>{{ $follower->name }}</span>
            <div class="row">
                <div class="col-xs-12"><span><a href="/{{$follower->account}}">{{ "@".$follower->account }}</a></span></div>
            </div>
        </div>
        <div class="col-xs-5 list-padding">
        @if( $follower->isFollow() )
            <button class="btn btn-success center-block">フォロー中</button>
        @else
            <button class="btn btn-primary center-block">フォロー</button>
        @endif
        </div>
    </div>
    @endforeach
@endsection