@extends('main')

@if (Auth::user()->type == 1)
    @section('panel-items')
        {!! menuItem('Users', '/users') !!}
        {!! menuItem('Create', '/users/create') !!}
    @endsection
@endif
