<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title'){{ config('app.name') }}</title>
    {{-- bundle した css と js --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--<script src="{{ asset('js/manifest.js') }}"></script>--}}
    {{--<script src="{{ asset('js/vendor.js') }}"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <header class="container-fluid">
        <div class="row">
            <div class="col-xs-1 icon-btn" >
                <button data-ham-click class="btn ham-btn">
                    <span  class="glyphicon glyphicon-align-justify"></span>
                    <span  class="glyphicon glyphicon-remove hum-close-button"></span>
                </button>
            </div>
            <nav id="drawrEvent" class="drawr">
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
                    @if(Auth::check())
                        <li><a href="{{ route('books.create') }}">本作成</a></li>
                        <li><a href="{{ route('bookshelf', Auth::user() -> account) }}">本棚</a></li>
                        <li><a href="{{ route('favorite', Auth::user() -> account) }}">お気に入り</a></li>
                    @else
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                    @endif
                        <li><a href="#">設定</a></li>
                        <li><a href="#">ヘルプ</a></li>
                    @if (Auth::check())
                        <li><form action="{{ route('logout') }}" method="post" name="logoutform">
                            {{ csrf_field() }}
                            <input type="hidden">
                            <a href="javascript:logoutform.submit()">ログアウト</a>
                        </form></li>
                    @endif
                </ul>
            </nav>
            <!-- <div class="col-xs-2" style="height:50px;padding-right:0px;padding-left: 0px;">
                <img src="{{ asset('img/siori_face.png') }}" alt="四葉栞" class="img-responsive img-icon" style="float:right;"/>
            </div> -->
            <div class="col-xs-6 col-xs-offset-2 logo-btn">
                <a href="{{ route('home') }}"><img src="{{ asset('img/logo01.png')}}" alt="タイトルロゴ" class="img-responsive" /></a>
            </div>
            @if(Auth::guest())
                <div class="col-xs-3" id="sn-icon" style="height: 50px;padding-top: 0.3em;">
                    <div class="row">
                        <a class="siori-bgc" href="{{ route('login') }}">sign up</a><br>
                        <a class="siori-bgc" href="{{ route('login') }}">sign in</a>
                    </div>
                </div>
            @else
                <div class="col-xs-3" id="sn-icon" style="padding-left:0px;">
                    <div class="row">
                        <div class="col-xs-4 icon-btn" style="">
                            <button class="btn btn-ghost" class="siori-bgc" onclick="location.href='{{route("search")}}'"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                        <div class="col-xs-4 col-xs-offset-1 icon-btn">
                            <button class="btn btn-ghost" class="siori-bgc"><span class="glyphicon glyphicon-bell"></span></button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </header>
    <main class="container">
        @yield('content')
    </main>
    <footer></footer>
</body>
    <link rel="stylesheet" href="{{ asset('css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hamburger.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.tagsinput.css') }}">

    <script src="{{ asset('js/util/selector.js') }}"></script>
    <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('js/drawr.js') }}"></script>
    <script src="{{ asset('js/moretext.js') }}"></script>
    <script src="{{ asset('js/textOverflowEllipsis.js') }}"></script>
    @yield('resources')
</html>
