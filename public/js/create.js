$('#tags').tagsInput({width:'auto'})

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
                    $('.check-link').append("<th class='check-lav'>"+$(this).children('.cnt-title').val()+"</th>" + 
                                            "<td class='check-url'>"+$(this).children('.cnt-url').val()+"</td>");

                else if($(this).children('.cnt-title').val() == "" && $(this).children('.cnt-url').val() !== "") 
                {
                    $('.check-link').append("<th class='check-lav'>タイトル未入力</th><td class='check-url'>"+$(this).children('.cnt-url').val()+"</td>");                    
                }
                else if($(this).children('.cnt-url').val() == "" && $(this).children('.cnt-title').val() !== "")
                { 
                    $('.check-link').append("<th class='check-lav'>"+$(this).children('.cnt-title').val()+"</th><td class='check-url'>URL未入力</td>");
                }
            });
            //タグを確認画面へ書き込む処理
            taggroup = $('#tags').val().split(',');
            $.each(taggroup,function(num,val){$('.check-tag').append("<p>",val,"</p>")});
            
            //公開設定を確認画面へ書き込む処理
            var adult = ($('.adult input[name=is_adult]:checked').val() == 'true') ? '公開する':'公開しない';
            var comment = ($('.commentable input[name=is_commentable]:checked').val() == 'true') ? '許可する':'許可しない';
            var publishing = ($('.publishing input[name=is_publishing]:checked').val() == 'true') ? '公開する':'公開しない';
            $('#adult').text(adult);
            $('#comment').text(comment);
            $('#publishing').text(publishing);
            
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
        $('.check-tag').empty();
        $('#input-item').toggle();
        $('#check').toggle();

    });

    $('#create').on('click',function()
    {
        var myRet = confirm("本を作成します、よろしいですか？");
        if ( myRet == true )
        {
            var eachnum = 0;
            $('.cnt').each(function()
            {
                $('.url-group').append('<input type="hidden" name="anchors['+eachnum+'][name]" value="'+$(this).children('.cnt-title').val()+'">');
                $('.url-group').append('<input type="hidden" name="anchors['+eachnum+'][url]" value="'+$(this).children('.cnt-url').val()+'">');
                eachnum++;
            });

            $.each(taggroup,function(num,val)
            {
                $('.taggroup').append('<input name="tags['+num+']" value="'+val+'">');
            });
            $('.form-horizontal').submit();
        }          
    
    });
    
});
            // $.ajax(
            // {
            //     type : 'POST',
            //     url : '/books/new',
            //     dataType : 'json',
            //     data : 
            //     {
            //         'title' : $('#title').val(),
            //         'description' : $('#description').val(),
            //         'tags' : taggroup,
            //         'anchors' : anchors
            //     },
            //     //contentType : 'application/json'
            // })
            
            // .done(function(res)
            // {
            //     if(res.hasCreated)
            //     {   
            //         location.href=res.redirectTo;
            //     }
            //     else
            //     {
            //         alert("本の作成に失敗しました");
            //         taggroup = null;
            //         $('.check-link').empty();
            //         $('#input-item').toggle();
            //         $('#check').toggle();
            //     }
            // });