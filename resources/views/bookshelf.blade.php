@extends('layouts.template')

@section('content')
        <div class="col-xs-12 center">
            <div class="bg-success">
                    <div class="col-xs-6">
                        <label for="selection">ソート:</label>
                            <select id="selection" class="form-control">
                                <option value="asc">昇順
                                <option value="desc">降順
                                <option value="new">新着順
                            </select>
                    </div>
                    <div class="col-xs-6">
                        <label for="name">絞込:</label>
                        <input type="text" id="refine" class="form-control">
                    </div>
            </div>
        </div>
        <div class="col-xs-12 container">

        @foreach($books as $book)
           @component("components.book",
           [
                'id' => $book["id"],
                'title' => $book["title"],
                'isFavorite' => $book["isFavorite"]
           ])
           @endcomponent
        @endforeach
        </div>

        <script>
            $(function()
            {
                $('.book').on('click',function()
                {
                    var num = $(".book").index(this);
                    window.location.href = '/books/' + $('.bookid').eq(num).text();
                });

                $('#selection').on('change',function()
                {
                    console.log($('#selection').val());
                });
            });
        </script>
@endsection