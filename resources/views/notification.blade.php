@extends('layouts.template')

@section('content')
    <button class="btn btn-link btn-lg btn-block back-btn">
        <span class="glyphicon glyphicon-arrow-left"></span>
        通知ページ
    </button>
    <div class="row list-padding-border">
        <div class="col-xs-2 col-xs-offset-1 list-padding">
            <img src="img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon" />
        </div>
        <div class="list-padding-right textOverflow">
            <span>四葉栞さんにフォローされました。</span>
        </div>
        <div class="list-padding-date">
            2017/07/31
        </div>        
    </div>
    <div class="row list-padding-border">
        <div class="col-xs-2 col-xs-offset-1 list-padding">
            <img src="img/mamoru_face.png" alt="まもる" class="img-circle img-responsive img-icon" />
        </div>
        <div class="list-padding-right textOverflow">
            <span>本田守さんに～がお気に入りされました。</span>
        </div>
        <div class="list-padding-date">
            n時間前
        </div>
    </div>
@endsection