@extends('main')

@section('panel-items')
@foreach(App\Camera::all() as $c)
    {!! menuItem($c->name, "/library/camera/$c->id") !!}
@endforeach
@endsection
