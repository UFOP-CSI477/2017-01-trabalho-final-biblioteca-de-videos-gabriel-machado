@extends('library.main')

@section('content')

<div class="row text-center text-lg-left">
@foreach($cam->videos as $v)
  <div class="col-lg-3 col-md-4 col-xs-6 thumbnail-pad">
    <a href="#" class="d-block mb-4 h-100">
      <img class="img-fluid img-thumbnail" src="/frame/{{ $v->first_frame->id }}" alt="">
      {{ $v->datetime }}
    </a>
  </div>
@endforeach
</div>

@endsection

@section('scripts')

@endsection

@section('styles')

@endsection
