@extends('layouts.template')

@section('content')

<div class="container">
    <form class="form-horizontal">

        <div class="form-group">
            <label for="title">タイトル:</label>
            <input type="text" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">概要:</label>
            <textarea id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="tag">タグ:</label>
            <input type="text" id="tag" class="form-control">
        </div>
        <div class="form-group">
            <label for="Adults">１８歳未満への公開:</label>
            <input type="checkbox"  data-toggle="toggle" data-on="Enabled" data-off="Disabled">
        </div>
        <div class="form-group">
            <label for=""></label>
        </div>

    </form>
</div>

<script>
  $(function() 
  {
    $('#toggle-two').bootstrapToggle(
    {
      on: 'Enabled',
      off: 'Disabled'
    });
  })
</script>


@endsection