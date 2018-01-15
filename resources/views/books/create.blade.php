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
            <input id="title" type="text" class="form-control" placeholder="タイトル">
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <textarea id="description" class="form-control" rows="3" placeholder="概要" style="resize: vertical"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>タグ</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <select id="tags" class="form-control" multiple data-role="tagsinput"></select>
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
                    <input id="isPublished" type="checkbox" class="form-control" checked
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
                    <input id="isCommentable" type="checkbox" class="form-control" checked
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
    <form id="submitForm" action="/books" method="post">
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
  isPublished: '#isPublished',
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

  constructor() {
    this.jqueryObject = $(Link.ELEMENT);

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

  // link field のひとつ目を追加
  const link = new Link();
  $('#linkList').append(link.render());

  const initalState = {
    links: [link],
  };

  return initalState;
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

  $(Trigger.confirmButton).on('click', (e) => {
    // form の値を取得
    const results = {
      title: $(Book.title).val(),
      description: $(Book.description).val(),
      isPublished: $(Book.isPublished).prop('checked'),
      isCommentable: $(Book.isCommentable).prop('checked'),
      tags: $(Book.tags).val(),
      links: state.links.filter(link => link.url() !== "" && link.title() !== "")
    };

    console.log(results);
    
    const mapToInputTag = (name, value) => `<input type="hidden" name="${name}" value="${value}">`;
    
    const submitParameters = {
      title:       mapToInputTag('title', results.title),
      description: mapToInputTag('description', results.description),
      isPublished: mapToInputTag('is_publishing', results.isPublished),
      isCommentable: mapToInputTag('is_commentable', results.isCommentable),
      tags: results.tags.map((tag, idx) => mapToInputTag(`tags[${idx}]`, tag)),
      links: results.links.map((link, idx) => [
        mapToInputTag(`anchors[${idx}][url]`, link.url()),
        mapToInputTag(`anchors[${idx}][name]`, link.title())
      ]).reduce((arr, link) => arr.concat(link), []) // 多次元配列を二次元へ変換
    };

    console.log(submitParameters);

    const submitForm = $(Book.submitForm);
    $.each(submitParameters, (__, element) => {
      if ($.isArray(element)) element.forEach(el => submitForm.append($(el)));
      else submitForm.append($(element));
    });
    {{--  submitForm.submit();  --}}
  });
});

</script>
    {{--<script src="{{ asset('js/create.js') }} "></script>--}}
@endsection
