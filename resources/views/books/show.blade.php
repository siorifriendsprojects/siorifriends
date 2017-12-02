@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="h4 user">著者名 : {{ $book->author->account}}</div>
            <h3 class="lines-empty text-center">{{ $book->title }}</h3>
            <h6 class="create-date text-center">作成日 : {{ $book->created_at->format('Y-m-d H:i')}}</h6>

            <div class="lines-empty text-center">
                {{ $book->description }}
            </div>

            <div class="page text-left">
                {{-- linkの一覧を表示 --}}
                <div class="list-group">
                    @foreach($book->anchors as $anchor)
                        <a href="{{ $anchor->url }}" class="list-group-item list-group-item-action" target="_blank" style="color: #03a9f4">
                            {{ $anchor->pivot->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- ログイン状態、かつ、自分の本の場合に表示する --}}
    @if ($isMyBook)
        <div class="row">
            <div class="col-xs-1 col-xs-offset-3">
                {{--<button id="editButton" type="button" class="btn btn-primary">編集</button>--}}
                <a href="{{ route('books.edit', ['bookId' => $book->id]) }}" class="btn btn-primary" role="button">編集</a>
            </div>

            {{-- 本を削除するためのフォーム --}}
            <div class="col-xs-1 col-xs-offset-3">
                <form id="deleteForm" action="{{ route('books.destroy', ['bookId' => $book->id]) }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <button type="button" id="deleteButton" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    @endif

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

  // 削除ボタンを押した時に確認フォームを表示する
  $(Selector.deleteButton).on('click', function() {
    $(this).prop('disabled', true);
    const confirmMsg = '本を削除します\nよろしいですか?';
    // 確認画面を表示して OK が押されたら、form を送信する
    const ok = confirm(confirmMsg);
    if (ok) $(Selector.deleteForm).submit();
    $(this).prop('disabled', false);
  });
});
</script>
@endsection
