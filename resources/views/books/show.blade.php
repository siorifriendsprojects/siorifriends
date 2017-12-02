@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-5">
            <p>
                <a href="{{ route('overview', ['account' => $book->author->account]) }}">{{ $book->author->account}}</a>
            </p>
        </div>

        <div class="col-xs-5">
            <p>作成日 : {{ $book->created_at->format('Y-m-d H:i') }}</p>
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
                    <span class="label label-default">{{ $tag->name }}</span>
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


    <div class="comment">
        <div class="comm-li col-xs-offset-1"></div>
        <div class="form-group">
            <label for="comment-lav" class="left-block control-label">comment</label>
            <input type="text" id="input-comm" class="form-control">
            <button class="btn btn-primary lines-btn pull-right" id="comm-btn">投稿</button>
        </div>
    </div>
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
});
</script>
@endsection
