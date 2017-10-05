@extends('layouts.template')

@section('content')

<div class="container">
    <div class='col-xs-offset-1 col-xs-10' id='input-item'>
        <form class="form-horizontal col-xs-offset-1 col-xs-10">
            {{ csrf_field() }}
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
                <div class="url-group">
                    <div class="lines-empty cnt" >
                        <label for="title" class="h6">URL</label>
                        <input type="text" class="form-control cnt-url">
                        <label for="title" class="h6">タイトル</label>
                        <input type="text" class="form-control cnt-title">
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-circle pull-right lines-empty"><i class="glyphicon glyphicon-plus" id="addcnt"></i></button>
            </div>
                <!-- タグのグループ -->
            <div class="form-group">   
                <label for="tag">タグ:</label>
                <input type="text" id="tags" class="tags form-control" />
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
        <div class="check-h3" id="check-description"></div>
        <p class="check-h6">リンク</p>
        <table class="table third">
            <tr class="check-link">
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
    $('#tags').tagsInput({width:'auto'});
    $(function()
    {   
        $('#addcnt').on('click',function()
        {
            $('.cnt').last().clone().appendTo('.url-group');
            $('.cnt-title').last().val('');
            $('.cnt-url').last().val('');
        });
        $('#confirmation').on('click',function()
        {
            var taggroup = $('#tags').val().split(',');
            $.each(taggroup,function(num,val){$('.check-tag').append("<p>",val,"</p>")});
            $('#check-title').text($('#title').val());
            $('#check-description').text($('#description').val());
            $.each($('.cnt'),function()
            {
                if($(this).children('.cnt-title').val() !== "" && $(this).children('.cnt-url').val() !== "")
                    $('.check-link').append("<th>"+$(this).children('.cnt-title').val()+"</th><td>"+$(this).children('.cnt-url').val()+"</td>");
            });
            $('#input-item').toggle();
            $('#check').toggle();
            $('#check-description').jTruncSubstr(
            {
            length: 30,            // 表示させる文字数
            minTrail: 0,            // 省略文字の最低文字数
            moreText: "もっと読む",  // 非表示部分を表示するリンクの文字列
            lessText: "閉じる",       // 表示した後、再び非表示にするリンクの文字列
            ellipsisText: "...",    // 続きがあることを表示するための文字列
            moreAni: "fast",        // 表示時のアニメーション速度
            lessAni: "fast"         // 非表示時のアニメーション速度
            });  
        }); 
    });
</script>

@endsection