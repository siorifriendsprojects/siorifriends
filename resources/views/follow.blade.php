@extends('layouts.template')

@section('content')
        <button class="btn btn-link btn-lg btn-block back-btn">
            <span class="glyphicon glyphicon-arrow-left"></span>
            フォロー
        </button>
        @foreach ($followUsers as $followUser)
        <div class="row list-padding-border">
            <div class="col-xs-3 col-xs-offset-1 list-padding">
                <img src="/img/四葉栞_顔.png" alt="しおり" class="img-circle img-responsive img-icon" />
            </div>
            <div class="col-xs-3 list-padding"><span>{{ $followUser->name }}</span>
                <div class="row">
                    <div class="col-xs-12"><span><a href="/{{$followUser->account}}">{{ "@".$followUser->account }}</a></span></div>
                </div>
            </div>
            <div class="col-xs-5 list-padding">
            @if( $followUser->isFollow() )
                <button class="btn btn-success center-block">フォロー中</button>
            @else
                <button class="btn btn-primary center-block">フォロー</button>
            @endif
            </div>
        </div>
        @endforeach
@endsection