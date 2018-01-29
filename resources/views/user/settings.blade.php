@extends('layouts.template')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.0.0/cropper.min.css" rel="stylesheet" type="text/css" media="all"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.0.0/cropper.min.js"></script>

    <div class="container">
        <div class='col-xs-offset-1 col-xs-10' id='input-item'>
            <!-- 名前のグループ -->
            <form action="/settings" method="post" class="form-horizontal col-xs-offset-1 col-xs-10" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">名前:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{Auth::user()->name}}" >
                </div>
                <!-- アイコンのグループ -->
                <div class="form-group">
                    <label for="icon">アイコン:</label>
                    <input type="file" id="imgfile" accept='image/*' name="icon">
                    <div class="createicon">
                        <img src="" class="img-responsive" id="iconimage">
                    </div>
                    <div class="cropper"></div>
                    <a id="trimming" class="btn btn-default btn-sm" style="display:none">トリミング</a>
                </div>

                <!-- 誕生日のグループ -->
                <div class="form-group left-block">
                    <label for="birthday">生年月日:</label>
                    <input type="date" name="birthday" min="1900-12-31" max="{{ date('Y-m-d') }}" class="form-control" value="{{Auth::user()->profile->birthday}}">
                </div>
                <!-- 性別のグループ -->
                <div class="form-group">
                    <label for="gender">性別</label>
                    <input type="text" name="gender" id="gender" class="form-control" value="{{Auth::user()->profile->gender}}">
                </div>
                <!-- 自己紹介のグループ -->
                <div class="form-group">
                    <label for="intro">自己紹介:</label>
                    <textarea id="intro" name="intro" class="form-control" style="resize : none;">{{Auth::user()->profile->intro}}</textarea>
                </div>
                <!-- twitterのグループ -->
                <!-- facebookのグループ -->
                <!-- instagramのグループ -->
                <div class="text-center">
                    <div style="display:inline-flex">
                        <button class="btn btn-default" id="cancel">取消</button>
                        <button class="btn btn-default" id="edit">編集</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('resources')
    <script src="{{ asset('js/editprofile.js') }}"></script>
@endsection
