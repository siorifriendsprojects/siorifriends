@extends('layouts.template')

@section('content')

<div class="container">
    <form class="form-horizontal">
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
             <!-- タグのグループ -->
        <div class="form-group">   
            <label for="tag">タグ:</label>
            <input type="text" id="tag" class="form-control">
        </div>
              <!-- １８歳未満の公開設定 -->
        <label for="Adults">１８歳未満への公開設定:</label> 
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active">
                <input type="radio" autocomplete="off" checked> 公開する
            </label>
            <label class="btn btn-default">
                <input type="radio" autocomplete="off"> 公開しない
            </label>
        </div>

    </form>
</div>

@endsection