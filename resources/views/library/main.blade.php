@extends('main')

@section('panel-items')
@foreach(App\Camera::all() as $c)
    {!! menuItem($c->name, "/library/$c->id") !!}
@endforeach
@endsection
