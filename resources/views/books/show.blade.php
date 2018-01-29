@extends('layouts.template')

@section('title')
    {{$book->title}} /
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-4">
            <p>
                <a href="{{ route('overview', ['account' => $book->author->account]) }}">
                   {{ '@' }}{{ $book->author->account }}
                </a>
            </p>
        </div>

        <div class="col-xs-4">
            <p>作成日 : {{ $book->created_at->format('Y-m-d H:i') }}</p>
        </div>
        @if(Auth::check())
            <div class="col-xs-2 text-right">
        @else
            <div class="col-xs-4 text-right">
        @endif
        {{-- 共有ボタンに関する項目 --}}
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-expanded="false">
                        <span class="glyphicon glyphicon-share-alt"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
                        target="_blank" data-siori-link-click>Facebook</a></li>
                        <li><a href="https://line.me/R/msg/text/?{{ Request::fullUrl() }}"
                        target="_blank" data-siori-link-click>LINE</a></li>
                        <li>                        
                        <a class="slack-button-widget" data-source="http://slackbutton.herokuapp.com/embed"
                        href="http://slackbutton.herokuapp.com/post/new" data-url="{{ $book->title }} / {{ config('app.name') }} {{ Request::fullUrl() }}"
                        target="_blank" data-siori-link-click>
                            Slack</a></li>
                        <li><a href="https://twitter.com/share?url={{ Request::fullUrl() }}&amp;text={{ $book->title }} / {{ config('app.name') }}"
                        target="_blank" data-siori-link-click>Twitter</a></li>
                    </ul>
                </div> 
            </div>

        {{-- ログイン状態、かつ、自分の本の場合に表示する --}}
        @if ($isMyBook)
            {{-- menu button --}}
            <div class="col-xs-2 text-right">
                <div class="dropdown">
                    <button id="dropdownMenuButton" class="btn btn-default dropdown-toggle"
                            type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuBtn">
                        <li><a href="{{ route('books.edit', ['bookId' => $book->id]) }}">編集</a></li>
                        <li class="alert-danger">
                            <a id="deleteButton" class="alert-link" href="#">削除
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h1>{{ $book->title }}</h1>
        </div>
    </div>

    {{-- tag の一覧を表示 --}}
    <div class="row">
        <div class="col-xs-12">
            <p class="h4">
                @foreach($book->tags as $tag)
                    <span class="label label-default" onclick="location.href='{{route("search")."?tag="}}{{$tag->name}}'">{{ $tag->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="lines-empty text-center">
                {{ $book->description }}
            </div>
        </div>
    </div>

    {{-- linkの一覧を表示 --}}
    <div class="row">
        <div class="col-xs-12">
            <div class="list-group">
                @foreach($book->anchors as $anchor)
                    <a href="{{ $anchor->url }}"
                       class="list-group-item list-group-item-action"
                       target="_blank"
                       style="color: #03a9f4">
                        {{ $anchor->pivot->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- コメントの一覧を表示 --}}
    @if($book->is_commentable)
    <?php $i = 1; ?>
    <hr />
        <div class="row">
            <div class="col-xs-12">
                    <ul class="list-group">
                @foreach($book->comments->sortBy("created_at") as $comment)
                        <li class="list-group-item">
                            <p class="h4"><?php echo $i++; ?> . {{ $comment->body }}</p>
                            <p><a href="/users/{{ $comment->commentUser->account }}">{{ "@".$comment->commentUser->account }}</a>  :  {{ $comment->created_at }}</p>
                        </li>
                @endforeach
                    </ul>
            </div>    
        </div>
            <div class="row">
                <div class="comment">
                <form action="{{ route('addComment', ['bookId' => $book->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="comment-lav" class="left-block control-label">comment</label>
                        <input type="text" id="input-comm" class="form-control" name="body" />
                        <button class="btn btn-primary lines-btn pull-right" id="comm-btn">投稿</button>
                    </div>
                </form>
                </div>
            </div>
    @endif
</div>
@endsection

@section('resources')
<script>
$(function() {
  // 必要な html 要素のセレクタ
  const Selector = {
    deleteButton: '#deleteButton',
    deleteForm  : '#deleteForm',
  };

  const deleteFormElements = `
    <form id="deleteForm" action="{{ route('books.destroy', ['bookId' => $book->id]) }}" method="post">
        {{ method_field('delete') }}
        {{ csrf_field() }}
    </form>
  `;

  // 削除ボタンを押した時に確認フォームを表示する
  $(Selector.deleteButton).on('click', function() {
    const confirmMsg = '本を削除します\nよろしいですか?';
    // 確認画面を表示して OK が押されたら、form を送信する
    const ok = confirm(confirmMsg);
    if (ok) {
        const deleteForm = $(deleteFormElements);
        $(document.body).append(deleteForm);
        deleteForm.submit();
    }
  });

    //SNS共有ボタンを押した後、新規ウィンドウで開き、画面中央に表示する
    $("[data-siori-link-click]").on("click", function() {
        const sw = ( screen.width - 640 ) / 2;
        const sh = ( screen.height - 480 ) / 2;
        window.open(this.href,"shareWindow","width=640,height=480" + ",left=" + sw + ",top=" + sh);
        return false;
    })
});
</script>
{{-- Slackで共有するためのスクリプト --}}
<script src="http://slackbutton.herokuapp.com/widget.js" type="text/javascript"></script>
@endsection
