@extends('main')

@section('panel-items')
    {!! menuItem('Tests', '/tests') !!}
    {!! menuItem('Create', '/tests/create') !!}
@endsection
