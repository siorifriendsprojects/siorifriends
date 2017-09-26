@extends('layouts.template')

@section('content')

<div class="container">
    <form class="form-horizontal col-xs-offset-1 col-xs-10">
            <!-- タイトルのグループ -->
        <div class="form-group">   
            <label for="title">タイトル:</label>
            <input type="text" id="title" class="form-control">
        </div>
            <!-- 概要のグループ -->
        <div class="form-group">    
            <label for="description">概要:</label>
            <textarea id="description" class="form-control"></textarea>
        </div>
            <!-- URL追加ページのグループ  -->
        <div class="form-group" >
            <label for="addURL">内容の追加:</label>
            <div id="url-group">
                <div class="lines-empty" id="cnt" >
                    <label for="title" class="h6">URL</label>
                    <input type="text" id="cnt_url" class="form-control">
                    <label for="title" class="h6">タイトル</label>
                    <input type="text" id="cnt_title" class="form-control">
                </div>
            </div>
                <button type="button" class="btn btn-default btn-circle pull-right lines-empty"><i class="glyphicon glyphicon-plus" id="addcnt"></i></button>
        </div>

            <!-- タグのグループ -->
        <div class="form-group">   
            <label for="tag">タグ:</label>
            <input type="text" id="tag" class="form-control">
        </div>
            <!-- １８歳未満の公開設定 -->
        <div class="form-group text-center">
            <p class="pull-left"><label for="Adults">１８歳未満への公開設定:</label> </p>
            <div class="btn-group text-center" data-toggle="buttons">
                <label class="btn btn-default active">
                    <input type="radio" autocomplete="off" checked> 公開する
                </label>
                <label class="btn btn-default">
                    <input type="radio" autocomplete="off"> 公開しない
                </label>
            </div>
        </div>
            <!-- 確定ボタン -->
        <div class="text-center">
            <button class="btn btn-default">確定</button>
        </div>

    </form>
</div>

<script>
    $(function()
    {
        $('#addcnt').on('click',function()
        {
            $('#cnt').clone().appendTo('#url-group');
        });
    });

</script>

@endsection