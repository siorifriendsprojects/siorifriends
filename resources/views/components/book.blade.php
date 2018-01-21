<div data-siori-component="book" class="col-xs-3 obj">
    <div class="col-xs-12">
        <div class="book_shadow">
            <div class="book">
                <div hidden class="bookid">{{ $id }}</div>
                <div class="booktitle_space">
                <span class="booktitle">{{ $title }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="userback">
            <div class="is_favo">
            @if($isFavorite)
                <span data-siori-button="favorite" class="glyphicon glyphicon-star bookuserID"></span>
            @else
                <span data-siori-button="favorite" class="glyphicon glyphicon-star-empty bookuserID"></span>
            @endif
            </div>
        </div>
    </div>
</div>