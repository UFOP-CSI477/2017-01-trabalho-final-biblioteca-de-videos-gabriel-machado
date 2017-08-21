@extends('library.main')

@section('content')

<div class="row text-center text-lg-left">
@foreach($vids as $v)
  <div class="col-lg-3 col-md-4 col-xs-6 thumbnail-pad">
    <a href="/library/video/{{ $v->id }}" class="d-block mb-4 h-100">
      <img class="img-fluid img-thumbnail" src="/frame/{{ $v->first_frame->id }}" alt="">
      {{ $v->datetime }}
    </a>
  </div>
@endforeach
</div>

@endsection

@section('filter-items')
  {!! filterItem('Jan','01') !!}
  {!! filterItem('Feb','02') !!}
  {!! filterItem('Mar','03') !!}
  {!! filterItem('Apr','04') !!}
  {!! filterItem('May','05') !!}
  {!! filterItem('Jun','06') !!}
  {!! filterItem('Jul','07') !!}
  {!! filterItem('Aug','08') !!}
  {!! filterItem('Sep','09') !!}
  {!! filterItem('Oct','10') !!}
  {!! filterItem('Nov','11') !!}
  {!! filterItem('Dec','12') !!}
@endsection
