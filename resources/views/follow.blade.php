<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="/css/default.css" rel="stylesheet">
    <link href="/css/hamburger.css" rel="stylesheet">
    <title>栞ふれんず。</title>
    <style>
    </style>
</head>
<body>
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
                        <img src="/img/四葉栞_顔.png" alt="しおり" class="img-circle img-responsive img-icon" />
                    </div>
                    <div class="col-xs-12" style="color:white;text-align:center;">
                        {{$user->name}}<br>
                        {{"@".$user->account}}
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
                <button class="btn bg-white"><img src="/img/栞ふれんず。ロゴ02.png" alt="タイトルロゴ" class="img-responsive"></img></button>
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
    <main>
        <button class="btn btn-link btn-lg btn-block back-btn">
            <span class="glyphicon glyphicon-arrow-left"></span>
            フォロー
        </button>

        @foreach ($followUsers as $followUser)
        <div class="row list-padding-border">
            <div class="col-xs-3 col-xs-offset-1 list-padding">
                <img src="/img/四葉栞_顔.png" alt="しおり" class="img-circle img-responsive img-icon" />
            </div>
            <div class="col-xs-3 list-padding"><span>{{ $followUser->name }}</span>
                <div class="row">
                    <div class="col-xs-12"><span><a href="/{{$followUser->account}}">{{ "@".$followUser->account }}</a></span></div>
                </div>
            </div>
            <div class="col-xs-5 list-padding">
                <button class="btn btn-success center-block">フォロー中</button>
            </div>
        </div>
        @endforeach
    </main>
    <footer></footer>
    <script src="/js/drawr.js"></script>
</body>
</html>