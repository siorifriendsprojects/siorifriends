/***
 * bookコンポーネントの振る舞いを記述するファイルです
 * */

/***
 * お気に入りボタン
 */
$(SioriSelector.componentSelectorGenerate("book")).find(SioriSelector.eventTriggerSelectorGenerate("button","favorite")).on("click",function(){

    const favoriteButton = $(this);

    const bookId = $(this).closest(SioriSelector.componentSelectorGenerate("book")).find(".bookid").text();

    var ajaxData = {
        type : 'post',
        data : JSON.stringify({"bookId":bookId,"token":localStorage.getItem("token")}),
        contentType: 'application/json',
        dataType : 'json',
        scriptCharset: 'utf-8',
        error : function(data) {
            // Error
            alert("error");
//            console.log(data);
//            $("html").html(data.responseText);
        }
    };

    if($(this).hasClass("glyphicon-star")){
        ajaxData.url = "/api/v1/favorites/destroy";

        ajaxData.success = function(data){
            console.log(data);
            favoriteButton.removeClass("glyphicon-star");
            favoriteButton.addClass("glyphicon-star-empty");
        };

    }else if($(this).hasClass("glyphicon-star-empty")){
        ajaxData.url = "/api/v1/favorites/create";

        ajaxData.success = function(data){
            console.log(data);
            favoriteButton.removeClass("glyphicon-star-empty");
            favoriteButton.addClass("glyphicon-star");
        };
    }

    $.ajax(ajaxData);
});