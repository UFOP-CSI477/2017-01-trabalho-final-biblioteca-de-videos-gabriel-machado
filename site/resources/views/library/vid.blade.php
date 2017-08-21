@extends('library.main')

@section('content')


<div class="row">
  <h2>{{ $vid->datetime }}</h2>
  <div class="col-md-10 col-md-offset-1 thumbnail-pad">
    <div class="img-thumbnail">
      <img id="videoframe" class="img-fluid play" src="/frame/{{ $vid->first_frame->id }}" alt="">
    </div>
    <div class="pull-left">
      <button class="btn btn-link" id="prev"><span class="glyphicon glyphicon-step-backward"></button>
      <button class="btn btn-link play" id="play"><span class="glyphicon glyphicon-play"></span></button>
      <button class="btn btn-link" id="next"><span class="glyphicon glyphicon-step-forward"></span></button>
      <span class="btn" id="framenum" role="icon">0</span>
    </div>
<!--    <div class="pull-right btn-group">
      <form class="form" role="form" method="post" action="/library/video/{{ $vid->id }}/flag" accept-charset="UTF-8" id="login-nav">
        {{ csrf_field() }}
        <input type="hidden" id="frameid" name="frame" value="-1">
        <button class="btn btn-link" type="submit"><span class="glyphicon glyphicon-flag"></span></button>
      </form>
    </div>-->
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
    <div class="col-md-7 col-md-offset-2">
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
$(document).ready(function() {
    var frames
    var playing = false
    var label = $('#framenum'), frameid = $('#frameid')

    updateFrame = function() {
        var myImageElement = document.getElementById("videoframe");
        myImageElement.onload = function() {
            label.html(counter)
            frameid.val(frames[counter])
        };
        myImageElement.src = "/frame/" + frames[counter];
    }

    var counter = 0,
    interval,
    play = function() {
        playing = true;
        $('#play>span').attr('class', 'glyphicon glyphicon-pause');
        interval = setInterval(function() {
            counter = (counter+1) % frames.length;
            updateFrame()
        }, 500);
    };

    $.getJSON( "/library/video/{{ $vid->id }}/seq", function(data) {
        frames = data;
        play()
    });

    stop = function() {
        playing = false
        $('#play>span').attr('class', 'glyphicon glyphicon-play');
        clearInterval(interval)
    }

    $('.play').click(function() {
        if (playing) {
            stop();
        } else {
            play();
        }
    });

    $('#rewind').click(function() {
        counter = 0;
        updateFrame();
    });

    $('#prev').click(function() {
        stop();
        --counter;
        if (counter < 0)
            counter = frames.length-1;
        updateFrame();
    });

    $('#next').click(function() {
        stop();
        counter = (counter+1) % frames.length;
        updateFrame();
    });
});
</script>
@endsection
