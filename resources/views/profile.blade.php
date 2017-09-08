@extends('layouts.template')

@section('content')
  <div  class="container-fluid">
	<div class="row">
		 <div class="col-xs-2 col-xs-offset-10" >
                <button class="btn bg-white"><span class="glyphicon glyphicon-cog"></span></button>
          </div>
	</div>
	
	<div class="row">
		<div class="col-xs-12"><img src="{{asset('img/doraemon_face.jpg')}}" width="80" height="80" alt="アイコン" class="img-circle center-block"></div>
	</div>
		<div class="col-xs-12  text-nowrap"><div class="col-xs-5 ">フォロー:121212</div> <div class="col-xs-5 ">フォロワー:2454545</div></div>
	
	<div class="row">
	</div>
	
	<div class="row">
		<div class="pr   col-xs-	col-xs-offset-3  " text align="left" >うわーーー！　うぇひひひひ　いひひひ　あははは　あははは　うぃひひひひ　あーはー！　うぉー！うわああああああああ！　しゃべったああああああああ！
		</div>
	</div>
  </div>

  <hr/>
  "本棚"
  <div class="col-xs-12 container">
            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
  <hr/>
  "お気に入り"
  <div class="col-xs-12 container">
            <div class="col-xs-3 obj">
                <div class="col-xs-12">
                    <div class="book_shadow">
                        <div class="book">
                            <div class="booktitle_space">
                            <span class="booktitle">世界の作り方</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="userback">
                        <div class="bookuserID">
                            <span class="bookuserID glyphicon glyphicon-bookmark bookuserID">userID</span>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
@endsection