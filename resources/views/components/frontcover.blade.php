 <!-- 本一冊ここから -->
 <a href="{{ route('books.show', [ 'bookId' => $id ]) }}">
    <div class="col-xs-3 col-xs-offset-1 list-padding" style="padding-top: 0.4em;">
        <img src="{{ asset('img/mamoru_face.png') }}" alt="しおり" class="img-circle img-responsive img-icon"/>
    </div>
    <div class="col-xs-3 list-padding textOverflow" style="padding: 0.3em 0;">
            <span>{{ $title }}</span> 
    </div>
    <div class="col-xs-5 list-padding textOverflow">
        <span>{{ $description }}</span>
    </div>
    <div class="col-xs-12"><hr class="my-hr"></div>
</a>
<!-- 本一冊ここまで -->
