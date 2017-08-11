@extends('tests.main')

@section('content')

<div class="row">
  <div class="panel">
    <div class="panel-heading">
      <h3>New test</h3>
    </div>

    <form class="form-horizontal" method="post" action="{{ route('tests.store') }}">

      {{ csrf_field() }}

      <div class="form-group">
      <label for="procedure_id" class="col-md-3 control-label">Procedure:</label>
        <div class="col-xs-6">
          <select name="procedure_id" class="form-control" required>
            <option value="" disabled{{ old('procedure_id') == '' ? ' selected' : '' }}>Type</option>
@foreach ($procs as $e)
            <option value="{{ $e->id }}"{{ old('procedure_id') == $e->id ? ' selected' : '' }}>{{ $e->name }}</option>
@endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="date" class="col-md-3 control-label">Date:</label>
        <div class="col-xs-6"><input class="form-control" type="date" name="date" value="{{ old('date') }}" required></div>
      </div>

        <div class="form-group">
          <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Create" required></div>
        </div>
    </form>
  </div>
</div>
@endsection
