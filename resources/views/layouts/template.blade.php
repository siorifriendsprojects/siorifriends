<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    {{-- bundle した css と js --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--<script src="{{ asset('js/manifest.js') }}"></script>--}}
    {{--<script src="{{ asset('js/vendor.js') }}"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-xs-1 icon-btn">
                <button class="btn hum-btn">
                    <span class="glyphicon glyphicon-align-justify"></span>
                    <span class="glyphicon glyphicon-remove" style="display:none;color:white;"></span>
                </button>
                <nav class="drawr">
                    <div class="row">
                        <div class="col-xs-offset-5">
                            <img src="{{ asset('img/mamoru_face.png')}}" alt="しおり" class="img-circle img-responsive img-icon" />
                        </div>
                        <div class="col-xs-12" style="color:white;text-align:center;">
                        @if(Auth::guest())
                            User name<br>
                            account ID
                        @else
                            {{Auth::user()->name}}<br>
                            {{"@".Auth::user()->account}}
                        @endif
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
            <div class="col-xs-2" style="height:50px;padding-right:0px;">
                <img src="{{ asset('img/doraemon_face.jpg') }}" alt="どらちゃん" class="img-responsive img-icon" style="float:right;"/>
            </div>
            <div class="col-xs-6 logo-btn" style="padding-left:0px;background-color:#f0ffe8;">
                <button class="btn btn-ghost" style="padding-left:0px;">
                    <img src="{{ asset('img/logo01.png')}}" alt="タイトルロゴ" class="img-responsive" />
                </button>
            </div>
            @if(Auth::guest())
                <div class="col-xs-3" id="sn-icon" style="height: 50px;padding-top: 0.3em;">
                    <div class="row">
                        <a style="background-color:#f0ffe8;">sign up</a><br>
                        <a style="background-color:#f0ffe8;">sign in</a>
                    </div>
              </div>
            @else
                <div class="col-xs-3" id="sn-icon" style="padding-left:0px;">
                    <div class="row">
                        <div class="col-xs-4 icon-btn" style="">
                            <button class="btn btn-ghost" style="background-color:#f0ffe8;"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1 icon-btn">
                            <button class="btn btn-ghost" style="background-color:#f0ffe8;"><span class="glyphicon glyphicon-bell"></span></button>
                        </div>
                        <div class="col-xs-4">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer></footer>
</body>
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hamburger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.tagsinput.css') }}">

    <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('js/drawr.js') }}"></script>
    <script src="{{ asset('js/moretext.js') }}"></script>
    <script src="{{ asset('js/textOverflowEllipsis.js') }}"></script>
    @yield('resources')
</html>
