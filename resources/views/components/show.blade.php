<div class="h4 user">著者名 : {{ $account}}</div>
<h3 class="lines-empty text-center">{{ $title }}</h3>
<h6 class="create-date text-center">作成日 : {{ $createtime }}</h6>

<div class="lines-empty text-center">
    {{ $description }}
</div>

<div class="page text-left">
    <ul class="list-group">
        <h3>
        @foreach($anchors as $anchor)
            <li class="list-group-item"><a href="{{ $anchor->url }}">{{ $anchor->pivot->name }}</a></li>
        @endforeach
        </h3>
    </ul>
</div>