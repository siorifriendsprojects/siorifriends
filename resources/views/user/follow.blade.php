@extends('layouts.template')

@section('content')
    <button class="btn btn-link btn-lg btn-block back-btn">
        <span class="glyphicon glyphicon-arrow-left"></span>
        フォロー
    </button>

    @foreach ($users as $user)
        <div class="row list-padding-border">
            <div class="col-xs-3 col-xs-offset-1 list-padding">
                <img src="/img/四葉栞_顔.png" alt="しおり" class="img-circle img-responsive img-icon" />
            </div>
            <div class="col-xs-3 list-padding"><span>{{ $user->name }}</span>
                <div class="row">
                    <div class="col-xs-12"><span><a href="/{{ $user->account }}">{{ '@' . $user->account }}</a></span></div>
                </div>
            </div>

            @if( Auth::check() )
                <div class="col-xs-5 list-padding">
                @if( Auth::user()->isFollow($user->id) )
                    <button class="btn btn-success center-block">フォロー中</button>
                @else
                    <button class="btn btn-primary center-block">フォロー</button>
                @endif
                </div>
            @endif

        </div>
    @endforeach
@endsection