@extends('layouts.template')

@section('content')

<div class="container">
    {{--.row*2>.col-xs-12>.row*2>.col-xs-12--}}
    <div class="row">
        <div class="col-xs-12">
            <h1>本作成フォーム</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <input id="title" type="text" class="form-control" placeholder="タイトル" value="{{ isset($book) ? $book->title : "" }}">
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <textarea id="description" class="form-control" rows="3" placeholder="概要" style="resize: vertical">{{ isset($book) ? $book->title : "" }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>タグ</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <select id="tags" class="form-control" multiple data-role="tagsinput">
                @if(isset($book))
                  @foreach($book->tags as $tag)
                    <option selected value="{{ $tag->name }}">{{ $tag->name }}</opotion>
                  @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>リンク</h3>
        </div>
    </div>

    <div class="row">
        <div id="linkList" class="col-xs-12"></div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <button id="addLinkFieldBtn" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>オプション</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="row">
                <div class="col-xs-12">
                    <p>外部に公開するかどうか</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input id="isPublishing" type="checkbox" class="form-control"
                           {{ isset($book) ? ($book->is_publishing ? "checked" : "") : "checked" }}
                           data-toggle="toggle"
                           data-onstyle="primary" data-offstyle="danger"
                           data-on="public" data-off="private"
                           data-width="100">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center checkbox form-group">
            <div class="row">
                <div class="col-xs-12">
                    <p>コメント</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input id="isCommentable" type="checkbox" class="form-control"
                           {{ isset($book) ? ($book->is_commentable ? "checked" : "") : "checked" }}
                           data-toggle="toggle"
                           data-onstyle="primary" data-offstyle="danger"
                           data-on="許可" data-off="禁止"
                           data-width="100">
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 text-center">
            <button id="confirmBtn" type="button" class="btn btn-primary btn-lg btn-block">確認する</button>
        </div>
    </div>
    <form id="submitForm"
          {{--  更新の場合はpathにidを追加する  --}}
          action="/books{{ isset($book) ? "/" . $book->id : "" }}"
          method="post">
        @if(isset($book))
            {{ method_field('PUT') }}
        @endif
        {{ csrf_field() }}
    </form>
</div>
@endsection

@section('resources')
<script>
const Book = {
  title: '#title',
  description: '#description',
  tags: '#tags',
  isPublishing: '#isPublishing',
  isCommentable: '#isCommentable',
  submitForm: "#submitForm"
};

const Trigger = {
  previewButtons: '[data-button=preview]',
  confirmButton: '#confirmBtn',
  addLinkFieldButton: '#addLinkFieldBtn',
};

class Link {
   static get ELEMENT() {
     return `
    <div class="row" data-type="link">
        <div class="col-xs-12 form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="url" data-type="linkUrl">
                <div class="input-group-btn">
                    <button class="btn btn-info active" data-button="preview">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="title" data-type="linkTitle">
        </div>
    </div>
    `;
  }

  static get PreviewCallback() {
    return (e) => {
      const url = $(e.target).parents('[data-type=link]').find('[data-type=linkUrl]').val();
      window.open(url, '__blank');
    };
  }

  static get Selector() {
    return {
      previewButton: '[data-button=preview]',
      url: '[data-type=linkUrl]',
      title: '[data-type=linkTitle]',
    };
  }

  constructor(url = "", title = "") {
    this.jqueryObject = $(Link.ELEMENT);
    console.log(this.jqueryObject.find(Link.Selector.url));
    console.log(this.jqueryObject.find(Link.Selector.title));
    this.jqueryObject.find(Link.Selector.url).val(url);
    this.jqueryObject.find(Link.Selector.title).val(title);

    // click したら新しいタブを開く
    this.jqueryObject
        .find(Link.Selector.previewButton)
        .on('click', Link.PreviewCallback);
  }

  url() {
    return this.jqueryObject.find(Link.Selector.url).val();
  }

  title() {
    return this.jqueryObject.find(Link.Selector.title).val();
  }

  render() {
    return this.jqueryObject;
  }
}

/**
 * 初期化処理
 */
function initialize() {
  // tagの上限を設定
  $(Book.tags).tagsinput({
    maxTags: 10,
  });

  const links = [];
@if(isset($book))
  @foreach($book->anchors as $anchor)
    links.push(new Link("{{ $anchor->url }}", "{{ $anchor->pivot->name }}"));
  @endforeach
@endif
  // link field のひとつ目を追加
  links.push(new Link());
  links.forEach(link => $('#linkList').append(link.render()));
  {{--  $('#linkList').append(links[links.length - 1].render());  --}}

  const initalState = {
    links: links,
  };

  return initalState;
}

function mapToInputTag(name, value) {
  return `<input type="hidden" name="${name}" value="${value}">`;
}

class SubmitParameter {
  
}

/**
 * main
 */
$(() => {
  let state = initialize();

  $(Trigger.addLinkFieldButton).on('click', (e) => {
    const link = new Link();
    state.links = [...state.links, link];
    $('#linkList').append(link.render());
  });

  // 
  $(Link.Selector.url).on('blur', (e) => {
    $.ajax({
      type: "POST",
      url: "/acquisition.php",
      dataType: "text",
      data: { 'src' : $(e.target).val() },
    }).done(title => {
      console.log(title);
      $(Link.Selector.title).val(title);
    });
  });

  $(Trigger.confirmButton).on('click', (e) => {
    // form の値を取得
    const parameters = {
      title: $(Book.title).val(),
      description: $(Book.description).val(),
      is_publishing: $(Book.isPublishing).prop('checked'),
      is_commentable: $(Book.isCommentable).prop('checked'),
    };
    const tags = $(Book.tags).val();
    const links = state.links.filter(link => link.url() !== "" && link.title() !== "");

    // validations.
    if (parameters.title === '') {
      alert('タイトルを入力してください。');
      return;
    }

    if (parameters.description === '') {
      alert('概要を入力してください。');
      return;
    }

    if (tags.length < 1) {
      alert("tag を入力してください");
      return;
    }
    if (10 < tags.length) {
      alert("tag は10個までです");
      return;
    }

    if (links.length < 1) {
      alert("link を入力してください");
      return;
    }
    if (30 < links.length) {
      alert("link は30個までです");
      return;
    }

    // input[type=hidden] に変換
    const elements = $.map(parameters, (value, key) => mapToInputTag(key, value))
      .concat(tags.map(tag => mapToInputTag('tags[]', tag))) // tag の配列をつなげる
      .concat(links.map((link, idx) => [                     // link の配列をつなげる
          mapToInputTag(`anchors[${idx}][url]`, link.url()),
          mapToInputTag(`anchors[${idx}][name]`, link.title())
        ]).reduce((arr, link) => arr.concat(link), [])
      ).map(element => $(element));


    // form にパラメータを追加して送信
    const submitForm = $(Book.submitForm);
    elements.forEach(element => submitForm.append(element))
    submitForm.submit();
  });
});

</script>
    {{--<script src="{{ asset('js/create.js') }} "></script>--}}
@endsection
