@extends('layouts.template')

@section('content')
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
            <h3 class="lines-empty">{{ $book->title }}</h3>
            
            <div class="lines-empty">
                {{ $book->description }}
            </div>

            <div class="page text-left">
                <ul class="list-group">
                    <h3>
                    @foreach($book->anchors as $anchor)
                        <li class="list-group-item"><a href="{{ $anchor->url }}">{{ $anchor->pivot->name }}</a></li>
                    @endforeach
                    </h3>
                </ul>
            </div>
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
            
            
            <!--
             <div class="sns">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="szmcafe">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    <div class="line-it-button" data-lang="ja" data-type="share-a" data-url="https://media.line.me/ja/how_to_install#lineitbutton" style="display: none;"></div>
                    <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
                    <script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
                        <a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="basic-label-counter" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="recommend" data-size="small" data-show-faces="false" data-share="false"></div>                
            </div>
                    
            -->
    </div>
    
@endsection