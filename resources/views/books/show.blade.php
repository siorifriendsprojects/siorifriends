@extends('layouts.template')

@section('content')
    <div class="col-xs-12 container">
        <div class="col-xs-12">
            <div class="h4 user">著者名 : {{ $book->author->account}}</div>
            <h3 class="lines-empty text-center">{{ $book->title }}</h3>
            <h6 class="create-date text-center">作成日 : {{ $book->created_at->format('Y-m-d H:i')}}</h6>

            <div class="lines-empty text-center">
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
            <div class="comment">
                <div class="comm-li col-xs-offset-1">
                </div>
                <div class="form-group">
                    <label for="comment-lav" class="left-block control-label">comment</label>
                    <input type="text" id="input-comm" class="form-control">
                    <button class="btn btn-primary lines-btn pull-right" id="comm-btn">投稿</button>
                </div>
            </div>
        </div>
    </div>
@endsection