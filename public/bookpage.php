<!--<?php

// $mysql = new mysqli($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'],
//     $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_NAME']);
//
// $sql = "INSERT INTO hoges(created_at) VALUES('" . date('Y-m-d H:i:s') . "')";
//
// $result = $mysql->query($sql);
//
// $sql = "SELECT * FROM hoges ORDER BY hoge_id desc limit 1";
//
// $result = $mysql->query($sql)->fetch_row();
//
// mysqli_close($mysql);
//var_dump($result);
?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/default.css" rel="stylesheet">
    <link href="css/hamburger.css" rel="stylesheet">


    <title>栞ふれんず。</title>
</head>


<header class="container-fluid">
        <div class="row">
            <div class="col-xs-3 icon-btn">
                <button class="btn bg-white hum-btn">
                    <span class="glyphicon glyphicon-align-justify"></span>
                    <span class="glyphicon glyphicon-remove" style="display:none;color:white;"></span>
                </button>
                <nav class="drawr">
                <div class="row">
                    <div class="col-xs-offset-5">
                        <img src="img/四葉栞_顔.png" alt="しおり" class="img-circle img-responsive img-icon" />
                    </div>
                    <div class="col-xs-12" style="color:white;text-align:center;">
                        User name<br>
                        account ID
                    </div>
                </div>   
                <ul id="menu">
                    <li><a href="#">本棚</a></li>
                    <li><a href="#">お気に入り</a></li>
                    <li><a href="#">設定</a></li>
                    <li><a href="#">ヘルプ</a></li>
                    <li><a href="#">ログアウト</a></li>
                </ul>
            </nav>
            </div>
            <div class="col-xs-6 logo-btn">
                <button class="btn bg-white"><img src="img/栞ふれんず。ロゴ02.png" alt="タイトルロゴ" class="img-responsive"></img></button>
            </div>
            <div class="col-xs-3" id="sn-icon" style="padding-left:0px;">
                <div class="row">
                    <div class="col-xs-4 icon-btn" style="">
                        <button class="btn bg-white"><span class="glyphicon glyphicon-search"></span></button>
                    </div>  
                    <div class="col-xs-4 col-xs-offset-1 icon-btn">
                        <button class="btn bg-white"><span class="glyphicon glyphicon-bell"></span></button>
                    </div>
                    <div class="col-xs-4">
                    </div>
                </div>
            </div>
        </div>
    </header>


<body>


    <div id="fb-root"></div>
        <script>
            (function(d, s, id) 
            {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.9";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

    
        <div class="col-xs-12 container">
            <div class="col-xs-12 text-center">
                <h3>アイマス関連</h3>
                <br />
                アイドルマスターに関係するサイト<br>
                全てアイマスに関係しています。<br>
                <br />

                <div class="page text-left">
                    <ul>
                        <h3>
                            <li><a href="#">公式HP</a></li>
                            <li><a href="#">THE IDOLM@STER</a></li>
                            <li><a href="#">ドカベン</a></li>
                            <li><a href="#">BBEMYBABY</a></li>
                            <li><a href="#">COBRA</a></ll>
                        </h3>
                    </ul>
                </div>


            <div class="sns">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="szmcafe">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                <div class="line-it-button" data-lang="ja" data-type="share-a" data-url="https://media.line.me/ja/how_to_install#lineitbutton" style="display: none;"></div>
                <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
                <script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
                <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="recommend" data-size="small" data-show-faces="false" data-share="false"></div>                
            </div>

            <br>
            <form class="form-horizontal">
                <div class="comment">
                        <div class="form-group">
                            <label for="name2" class="control-label col-xs-3">comment</label>
                            <div class="col-xs-9">
                                <input type="text" id="name2" class="form-control">
                            <button class="btn btn-primary btn-xs col-xs-offset-7">投稿</button>
                            </div>

                        </div>
                </div>
            </form>
        </div>
        
<script src="js/drawr.js"></script>
</body>
<footer>
        
</footer>
</html>
