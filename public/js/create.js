$(function()
{   
    var taggroup;
    $('#addcnt').on('click',function()
    {
        $('.cnt').last().clone().appendTo('.url-group');
        $('.cnt-title').last().val('');
        $('.cnt-url').last().val('');
    });
    $('#confirmation').on('click',function()
    {
        if(($('#title').val() && $('#description').val()) !== "")
        {
            //タイトルを確認画面へ書き込む処理
            $('#check-title').text($('#title').val());
            //概要を確認画面へ書き込む処理
            $('#check-description').text($('#description').val());
            //リンクを確認画面へ書き込む処理
            $.each($('.cnt'),function()
            {
                if($(this).children('.cnt-title').val() !== "" && $(this).children('.cnt-url').val() !== "")
                    $('.check-link').append("<th>"+$(this).children('.cnt-title').val()+"</th><td>"+$(this).children('.cnt-url').val()+"</td>");
            });
            //タグを確認画面へ書き込む処理
            taggroup = $('#tags').val().split(',');
            $.each(taggroup,function(num,val){$('.check-tag').append("<p>",val,"</p>")});
            
            //公開設定を確認画面へ書き込む処理
            var adult = ($('.adult input[name=is_adult]:checked').val() == 'true') ? '公開する':'公開しない';
            var comment = ($('.commentable input[name=is_commentable]:checked').val() == 'true') ? '許可する':'許可しない';
            var publishing = ($('.publishing input[name=publishing]:checked').val() == 'true') ? '公開する':'公開しない';
            $('#adult').children('strong').text(adult);
            $('#comment').children('strong').text(comment);
            $('#publishing').children('strong').text(publishing);
            
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
        }else {alert("タイトルと概要を入力してください")};  
    }); 

    $('#revision').on('click',function()
    {
        taggroup = null;
        $('.check-link').empty();
        $('#input-item').toggle();
        $('#check').toggle();

    });
});