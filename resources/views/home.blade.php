@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <!-- 検索フォーム -->
            <form action="{{ route("search") }}" method="get">
                <div class="col-xs-12 lines-empty">
                    <div class="input-group">
                        <input type="text" class="form-control" name="word" placeholder="検索検索ぅ">
                        <span class="input-group-btn">
                            <span class="glyphicon glyphicon-search"></span>
                            <button class="btn btn-default" type="submit">検索</button>
                        </span>
                    </div>
                </div>
            </form>
            <!-- 新着ランキング -->
            <div class="col-xs-12 ranking-list">
                <div class="text-center" style="border: 1px solid black">新着</div>
            </div>
            <div>
                @foreach($newBooks as $book)
                    @component("components.frontcover",
                    [
                            'id' => $book["id"],
                            'title' => $book["title"],
                            'description' => $book["description"]
                    ])
                    @endcomponent
                @endforeach
            </div>
            <a href="#" class="col-xs-5 col-xs-offset-7">→もっと見る</a>
            <!-- 人気ランキング -->
            <div class="col-xs-12 ranking-list">
                <div class="text-center" style="border: 1px solid black">人気</div>
            </div>
            <div>
                @foreach($newBooks as $book)
                    @component("components.frontcover",
                    [
                            'id' => $book["id"],
                            'title' => $book["title"],
                            'description' => $book["description"]
                    ])
                    @endcomponent
                 @endforeach
            </div>
            <a href="#" class="col-xs-5 col-xs-offset-7">→もっと見る</a>
        </div>
    </div>
@endsection