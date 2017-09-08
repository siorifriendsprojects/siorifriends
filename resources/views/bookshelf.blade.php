@extend('layout.template')

@section('content')
   <form class="form-inline">
        <div class="col-xs-12 center">

            <div class="bg-success">
                    <div class="col-xs-6">   
                        <label for="selection">ソート:</label>
                            <select id="selection" class="form-control">
                                <option>昇順
                                <option>降順
                                <option>新着順
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

        <?php for($i = 0; $i < 9; $i++){ ?>
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
        <?php } ?>
        </div>
@endsection