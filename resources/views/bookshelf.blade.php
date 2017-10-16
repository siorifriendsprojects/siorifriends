@extends('layouts.template')

@section('content')
   <form class="form-inline">
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
    </form>

        <div class="col-xs-12 container">

        @foreach($books->sortBy('ascription') as $book)
            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div hidden class="bookid">{{$book->id}}</div>
                            <div class="booktitle_space">
                            <span class="booktitle">{{ $book->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="is_favo">
                        @if(Auth::check() && $book->isFavorite(Auth::user()))
                            <span class="glyphicon glyphicon glyphicon-star bookuserID"></span>
                        @else
                            <span class="glyphicon glyphicon-star-empty bookuserID"></span>   
                        @endif
                        </div>
                    </div>
                </div>
            </div>
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