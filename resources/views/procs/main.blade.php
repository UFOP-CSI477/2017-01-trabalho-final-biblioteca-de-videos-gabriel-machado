@extends('main')

@if (Auth::user()->type == 1)
    @section('panel-items')
        {!! menuItem('Procedures', '/procedures') !!}
        {!! menuItem('Create', '/procedures/create') !!}
    @endsection
@endif
