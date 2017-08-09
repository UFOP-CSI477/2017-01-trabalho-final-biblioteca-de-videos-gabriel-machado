@extends('procs.main')

@section('content')

<div class="row">
  <div class="panel">
    <div class="panel-heading">
      <h3>New procedure</h3>
    </div>

    <form class="form-horizontal" method="post" action="{{ route('procedures.store') }}">

      {{ csrf_field() }}

      <div class="form-group">
          <label for="name" class="col-md-3 control-label">Name:</label>
          <div class="col-xs-6"><input class="form-control" type="text" name="name" value="{{ old('name') }}" required></div>
      </div>

      <div class="form-group">
        <label for="price" class="col-md-3 control-label">Price:</label>
        <div class="col-md-6">
          <input id="price" type="number" step="0.01" min="0" class="form-control" name="price" required>
        </div>
      </div>

        <div class="form-group">
          <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Create" required></div>
        </div>
    </form>
  </div>
</div>
@endsection
