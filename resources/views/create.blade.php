@extends('layouts.app')

@section('content')

<div class="container">
    <form class="form-horizontal">

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Overview:</label>
            <textarea id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="tag">Tag:</label>
            <input type="text" id="tag" class="form-control">
        </div>
        <div class="form-group">
            <label for="R18"></label>
            <input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
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