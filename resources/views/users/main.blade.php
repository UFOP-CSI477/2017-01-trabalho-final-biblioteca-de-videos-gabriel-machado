@extends('main')

@section('panel-items')
    {!! menuItem('Users', '/users') !!}
    {!! menuItem('Create', '/users/create') !!}
@endsection
