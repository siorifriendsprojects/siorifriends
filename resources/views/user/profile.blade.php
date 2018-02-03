@extends('layouts.template')

@section('content')
  <div  class="container-fluid">
	<div class="row">
		 <div class="col-xs-2 col-xs-offset-10" >
                <button class="btn bg-white"><span class="glyphicon glyphicon-cog"></span></button>
          </div>
	</div>
	
	<div class="row">
		<div class="col-xs-12"><img src="{{ asset($user->profile->icon_path) }}" width="80" height="80" alt="icon" class="img-circle center-block"></div>
	</div>
		<div class="col-xs-12  text-nowrap">
            <div class="col-xs-5 ">フォロー:{{ $user->follows()->count() }}</div>
            <div class="col-xs-5 ">フォロワー:{{ $user->followers()->count() }}</div>
        </div>

	<div class="row">
	</div>
	
	<div class="row">
		<div class="pr col-xs- col-xs-offset-3" text-align="left">
            {{ $user->profile->intro }}
		</div>
	</div>
  </div>

  <hr/>
  "本棚"
  <div class="col-xs-12 container">
      @foreach($user->books as $book)
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
                        <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">{{ $book->author->account }}</span>
                    </div>
                </div>
            </div>
        </div>
      @endforeach

  <hr/>
  "お気に入り"
  <div class="col-xs-12 container">
      @foreach($user->favorites as $favoriteBook)
            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">{{ $favoriteBook->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">{{ $favoriteBook->author->account }}</span>
                        </div>
                    </div>
                </div>
            </div>
      @endforeach
        </div>
    </div>
@endsection
