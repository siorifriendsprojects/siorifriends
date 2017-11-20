@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="col-xs-12">
            @component("components.show",
            [
                'account' => $book->author->account,
                'title' => $book->title,
                'createtime' => $book->created_at->format('Y-m-d H:i'),
                'description' => $book->description,
                'anchors' => $book->anchors,
            ])
            @endcomponent
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
@endsection