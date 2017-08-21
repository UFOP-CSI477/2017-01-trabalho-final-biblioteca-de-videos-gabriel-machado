@extends('library.main')

@section('content')


<div class="row">
  <h1>{{ $vid->datetime }}</h1>
  <div class="col-md-10 col-md-offset-1 thumbnail-pad">
    <img id="videoframe" class="img-fluid img-thumbnail" src="/frame/{{ $vid->first_frame->id }}" alt="">
  </div>
</div>


@foreach($vid->comments as $c)
<div class="row">
  <div class="col-sm-1 col-md-offset-1">
      <span class="glyphicon glyphicon-user gi-3x" role="icon"></span>
  </div>

  <div class="col-sm-7">
    <div class="panel panel-default comment">
      <div class="panel-heading ticked">
@if (Auth::user() == $c->user)
        <div class="dropdown pull-right">
          <button class="btn btn-link dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li>
              <form class="form" role="form" method="post" action="/library/comment/{{ $c->id }}/delete" accept-charset="UTF-8" id="login-nav">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE" >
                <button class="btn btn-link" type="submit">Delete</button>
              </form>
            </li>
          </ul>
        </div>
@endif
        <div class="panel-title">
          <strong>{{ $c->user->name }}</strong> <span class="text-muted">{{ $c->created_at }}</span>
        </div>
      </div>
      <div class="panel-body">
        {{ $c->text }}
      </div>
    </div>
  </div>
</div>
@endforeach

<form class="form-horizontal" method="post" action="/library/video/{{ $vid->id }}/comment">
  {{ csrf_field() }}

  <div class="form-group">
    <div class="col-xs-7 col-md-offset-2">
      <h3>Comment</h3>
      <textarea name="comment" class="form-control"></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Submit" required></div>
  </div>
</form>

@endsection

@section('scripts')
<script>
    var frames;
    $(document).ready(function() {

    var counter = 0,
    interval,
    label = $("#framenum"),
    fx = function() {
        interval = setInterval(function() {
            var myImageElement = document.getElementById("videoframe");
            myImageElement.onload = function() {label.html(counter)};
            myImageElement.src = "/frame/" + frames[counter];
            counter = (counter+1) % frames.length;
        }, 500);
    };

    $.getJSON( "/library/video/{{ $vid->id }}/seq", function(data) {
        frames = data;
        fx()
    });


    $("button").click(function() {
        clearInterval(interval);
        switch ($(this).index("button")) {
            case 0: label.html(--counter);break;
            case 1: clearInterval(interval);break;
            case 2: fx();break;
            case 3: label.html(++counter);break;
        };
    })
});
</script>
@endsection
