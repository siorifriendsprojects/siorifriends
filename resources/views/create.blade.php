@extends('layouts.template')

@section('content')

<div class="container">
    <div class='col-xs-offset-1 col-xs-10' id='input-item'>
        <form action="/books/store" method="post" class="form-horizontal col-xs-offset-1 col-xs-10">
            {{ csrf_field() }}
                <!-- タイトルのグループ -->
            <div class="form-group">   
                <label for="title">タイトル:</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
                <!-- 概要のグループ -->
            <div class="form-group">    
                <label for="description">概要:</label>
                <textarea id="description" name="description" class="form-control" style="resize : none;"></textarea>
            </div>
                <!-- URL追加ページのグループ  -->
            <div class="form-group" >
                <label for="addURL">リンクの追加:</label>
                <div class="url-group">
                    <div class="lines-empty cnt" >
                        <label for="title" class="h6">リンクタイトル</label>
                        <input type="text" class="form-control cnt-title">
                        <label for="title" class="h6">URL</label>
                        <input type="text" class="form-control cnt-url">
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-circle pull-right lines-empty"><i class="glyphicon glyphicon-plus" id="addcnt"></i></button>
            </div>
                <!-- タグのグループ -->
            <div class="form-group taggroup">   
                <label for="tag">タグ:</label>
                <input type="text" id="tags" class="form-control" />
            </div>
                <!-- 全体へ公開するか -->
            <div class="form-group text-center">
                <p class="pull-left"><label for="Comment">全体公開設定:</label></p>
                <div class="btn-group text-center publishing" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="is_publishing" autocomplete="off" value=true checked>公開する
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="is_publishing" autocomplete="off" value=false>公開しない
                    </label>
                </div>
            </div>
                <!-- １８歳未満の公開設定 -->
            <div class="form-group text-center">
                <p class="pull-left"><label for="Adults">１８歳未満公開設定:</label> </p>
                <div class="btn-group text-center adult" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="is_adult" autocomplete="off" value=true checked> 公開する
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="is_adult" autocomplete="off" value=false> 公開しない
                    </label>
                </div>
            </div>
                <!-- コメントの許可設定 -->
            <div class="form-group text-center">
                <p class="pull-left"><label for="Comment">コメントの許可設定:</label></p>
                <div class="btn-group text-center commentable" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" name="is_commentable" autocomplete="off" value=true checked> 許可する
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="is_commentable" autocomplete="off" value=false> 許可しない
                    </label>
                </div>
            </div>
        </form>
                <!-- 確認ボタン -->
            <div class="text-center col-xs-12">
                <button class="btn btn-default" id="confirmation">確認</button>
            </div>
    </div>
    <!-- ここから確認画面  -->
    <div class="col-xs-offset-1 col-xs-10" id='check' style='display:none'>
        <div class="lines-empty col-xs-12">
            <label class="check-cnt">タイトル</label>
            <div class="col-xs-offset-1 col-xs-11 check-lav" id="check-title"></div>
        </div>
        <div class="lines-empty col-xs-12">
            <label class="check-cnt">概要</label>
            <div class="col-xs-offset-1 col-xs-11 check-lav" id="check-description"></div>
        </div>
        
        <div class="lines-empty col-xs-12">
            <p class="check-cnt"><strong>リンク</strong></p>
                <table class="table third">
                    <tr class="check-link"></tr>
                </table>
        </div>
        
        <div class="lines-empty col-xs-12">
            <label class="check-cnt">タグ</label>
            <div class="col-xs-offset-1 col-xs-11 check-tag"></div>
        </div>

        <label class="check-cnt">公開設定</label>
        <div class="is-settings col-xs-offset-1 lines-empty">
            <div class="lines-empty">
                <label class="check-cnt" name="publishing">全体公開</label>
                <p class="check-lav" id="publishing"></p>            
            </div>
            <div class="lines-empty">
                <label class="check-cnt" name="adult">１８歳未満公開</label>
                <p class="check-lav" id="adult"></p>
            </div>
            <div class="lines-empty">
                <label class="check-cnt" name="commentable">コメントの許可設定</label>
                <p class="check-lav" id="comment"></p>
            </div>
        </div>
        
        <div class="text-center">
        <div style="display:inline-flex">
                <button class="btn btn-default" id="revision">修正</button>
                <button class="btn btn-default" id="create">作成</button>
        </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/create.js') }} "></script>
@endsection