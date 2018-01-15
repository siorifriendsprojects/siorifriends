@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default {{$tagSearch == false ? "active" : ""}}" onclick="$('input[data-siori-textbox=searchkey]').attr('name','word')">
                    <input type="radio" autocomplete="off" {{$tagSearch == false ? "checked" : ""}}> キーワード検索
                </label>
                <label class="btn btn-default {{$tagSearch == true ? "active" : ""}}" onclick="$('input[data-siori-textbox=searchkey]').attr('name','tag')">
                    <input type="radio" autocomplete="off" {{$tagSearch == true ? "checked" : ""}}> タグ検索
                </label>
            </div>
            <!-- 検索フォーム -->
            <form action="{{ route("search") }}" method="get">
                <div class="col-xs-12 lines-empty">
                    <div class="input-group">
                            <input type="text" class="form-control" data-siori-textbox="searchkey" name="word" placeholder="検索検索ぅ">
                            <span class="input-group-btn">
                                <span class="glyphicon glyphicon-search"></span>
                                <button class="btn btn-default" type="submit">検索</button>
                            </span>
                    </div>
                </div>
                <label for="orderby" class="control-label col-xs-2">並び替え</label>
                <div class="col-xs-10">
                    <select class="form-control" id="orderby" name="orderby">
                        <option value="create_desc" {{$orderby == "create_desc" ? "selected" : ""}}>作成日時の新しい順</option>
                        <option value="create_asc" {{$orderby == "create_asc" ? "selected" : ""}}>作成日時の古い順</option>
                        <option value="update_desc" {{$orderby == "update_desc" ? "selected" : ""}}>更新日時の新しい順</option>
                        <option value="update_asc" {{$orderby == "update_asc" ? "selected" : ""}}>更新日時の古い順</option>
                    </select>
                </div>
            </form>
            <div class="col-xs-12">
                <div class="text-center" style="border: 1px solid black">検索結果</div>
            </div>
            <div>
                @foreach($books as $book)
                    @component("components.frontcover",
                    [
                            'id' => $book["id"],
                            'title' => $book["title"],
                            'description' => $book["description"]
                    ])
                    @endcomponent
                @endforeach
            </div>
        </div>
        <div class="col-xs-10 col-xs-offset-1">
            <a href="{{$prevLink}}"><button style="width: 50%" class="btn btn-default" {{$isFirst ? "disabled" : ""}}>前</button></a><a href="{{$nextLink}}"><button {{$isLast ? "disabled" : ""}} class="btn btn-default" style="width: 50%">次</button></a>
        </div>
    </div>
@endsection