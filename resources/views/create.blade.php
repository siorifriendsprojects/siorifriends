@extends('layouts.template')

@section('content')

<div class="container">
    <div class='col-xs-offset-1 col-xs-10' id='input-item'>
        <form class="form-horizontal col-xs-offset-1 col-xs-10">
                <!-- タイトルのグループ -->
            <div class="form-group">   
                <label for="title">タイトル:</label>
                <input type="text" id="title" class="form-control">
            </div>
                <!-- 概要のグループ -->
            <div class="form-group">    
                <label for="description">概要:</label>
                <textarea id="description" class="form-control" style="resize : none;"></textarea>
            </div>
                <!-- URL追加ページのグループ  -->
            <div class="form-group" >
                <label for="addURL">リンクの追加:</label>
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
                <!-- コメントの許可設定 -->
            <div class="form-group text-center">
                <p class="pull-left"><label for="Adults">コメントの許可設定:</label></p>
                <div class="btn-group text-center" data-toggle="buttons">
                    <label class="btn btn-default active">
                        <input type="radio" autocomplete="off" checked> 許可する
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" autocomplete="off"> 許可しない
                    </label>
                </div>
            </div>
        </form>
                <!-- 確認ボタン -->
            <div class="text-center">
                <button class="btn btn-default" id="confirmation">確認</button>
            </div>
    </div>
    <!-- style="display: none;"  -->
    <div class="col-xs-offset-1 col-xs-10" id='check' style='display:none'>
        <label class="check-h6">タイトル</label>
        <div class="check-h3" id="check-title"></div>
        <label class="check-h6">概要</label>
        <p class="check-h3" id="check-description"></p>
        <p class="check-h6">リンク</p>
        <table class="table third" id=" check-link">
             <tr>
                <th>ABC</th>
                <td>td01-01</td>
            </tr>
        </table>

        <label class="check-h6">タグ</label>
        <div class="check-tag">

        </div>
        <label class="check-h6">公開設定</label>
        <p class="check-h3"></p>
        <p></p>
    </div>
</div>

<script>
    $(function()
    {
        $('#addcnt').on('click',function()
        {
            $('#cnt').clone().appendTo('#url-group');
        });

        $('#confirmation').on('click',function()
        {
            $('#check-title').text($('#title').val());
            $('#check-description').text($('#description').val());
            $('#input-item').toggle();
            $('#check').toggle();
        });

    });

</script>

@endsection