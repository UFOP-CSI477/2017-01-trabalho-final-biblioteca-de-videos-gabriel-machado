@extends('procs.main')

@section('content')


<div class="row">
  <div class="panel">
    <div class="panel-heading">
      <h3>Edit procedure</h3>
    </div>

    <form class="form-horizontal" method="post" action="{{ route('procedures.update', $procedure->id) }}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT" >

@if (Auth::user()->type == 1)
      <div class="form-group">
          <label for="name" class="col-md-3 control-label">Name:</label>
          <div class="col-xs-6">
            <input class="form-control" type="text" name="name" value="{{ $procedure->name }}" required>
@if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
@endif
          </div>
      </div>
@endif

      <div class="form-group">
          <label for="price" class="col-md-3 control-label">Price:</label>
          <div class="col-xs-6">
            <input class="form-control" type="text" name="price" value="{{ $procedure->price }}" required>
@if ($errors->has('price'))
              <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
              </span>
@endif
          </div>
      </div>

        <div class="form-group">
          <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Change"></div>
        </div>
    </form>
  </div>
</div>
@endsection
