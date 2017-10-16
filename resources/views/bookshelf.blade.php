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
                            <div class="booktitle_space">
                            <span class="booktitle">{{ $book->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                        @if(Auth::check() && $book->isFavorite(Auth::user()))
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">{{ $book->author->account }}</span>
                        @else
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">{{ $book->author->account }}</span>   
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
                $('#selection').on('change',function()
                {
                    console.log($('#selection').val());
                });
            });
        </script>
@endsection