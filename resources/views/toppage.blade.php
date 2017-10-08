@extends('layouts.template_toppage')

@section('content')
    <hr class="my-hr">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="検索検索ぅ">
        <span class="input-group-btn">
            <span class="glyphicon glyphicon-search"></span>
            <button class="btn btn-default" type="submit">検索</button>
        </span>
    </div>
    <hr style="border-top: 0px">
    <div class="row">
        <div class="col-xs-12 ranking-list">
            <div class="" style="border: 1px solid black">新着</div>
        </div>
        <div class="list-padding-border">
            <!-- 本一冊ここから -->
            <div class="col-xs-3 col-xs-offset-1 list-padding" style="padding-top: 0.4em;">
                <img src="/img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon"/>
            </div>
            <div class="col-xs-3 list-padding textOverflow" style="padding: 0.3em 0;">
               <span>タイトルタイトルタイトルタイトルタイトルタイトル</span> 
            </div>
            <div class="col-xs-5 list-padding textOverflow">
                <span>概要概要概要概要概要概要概要概要概要概要概要概要概要概要</span>
            </div>
            <div class="col-xs-12"><hr class="my-hr"></div>
            <!-- 本一冊ここまで -->
            <div class="col-xs-3 col-xs-offset-1 list-padding" style="padding-top: 0.4em;">
                <img src="/img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon"/>
            </div>
            <div class="col-xs-3 list-padding textOverflow" style="padding: 0.3em 0;">
               <span>タイトルタイトルタイトルタイトルタイトルタイトル</span> 
            </div>
            <div class="col-xs-5 list-padding textOverflow">
                <span>概要概要概要概要概要概要概要概要概要概要概要概要概要概要</span>
            </div>
            <div class="col-xs-12"><hr class="my-hr"></div>  
        </div>
        <a href="#" class="col-xs-4 col-xs-offset-8">→もっと見る</a>
    </div>
    <div class="row">
        <div class="col-xs-12 ranking-list">
            <div style="border: 1px solid black">人気</div>
        </div>
        <div class="list-padding-border">
            <!-- 本一冊ここから -->
            <div class="col-xs-3 col-xs-offset-1 list-padding" style="padding-top: 0.4em;">
                <img src="/img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon"/>
            </div>
            <div class="col-xs-3 list-padding textOverflow" style="padding: 0.3em 0;">
               <span>タイトルタイトルタイトルタイトルタイトルタイトル</span> 
            </div>
            <div class="col-xs-5 list-padding textOverflow">
                <span>概要概要概要概要概要概要概要概要概要概要概要概要概要概要</span>
            </div>
            <div class="col-xs-12"><hr class="my-hr"></div>
            <!-- 本一冊ここまで -->
            <div class="col-xs-3 col-xs-offset-1 list-padding" style="padding-top: 0.4em;">
                <img src="/img/siori_face.png" alt="しおり" class="img-circle img-responsive img-icon"/>
            </div>
            <div class="col-xs-3 list-padding textOverflow" style="padding: 0.3em 0;">
               <span>タイトルタイトルタイトルタイトルタイトルタイトル</span> 
            </div>
            <div class="col-xs-5 list-padding textOverflow">
                <span>概要概要概要概要概要概要概要概要概要概要概要概要概要概要</span>
            </div>
            <div class="col-xs-12"><hr class="my-hr"></div>
        </div>
        <a href="#" class="col-xs-4 col-xs-offset-8">→もっと見る</a>
    </div>
@endsection