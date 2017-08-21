@extends('users.main')

@section('content')


<div class="row">
  <div class="panel">
    <div class="panel-heading">
      <h3>Create user</h3>
    </div>

    <form class="form-horizontal" method="post" action="{{ route('users.store') }}">

      {{ csrf_field() }}

      <div class="form-group">
          <label for="name" class="col-md-3 control-label">Name:</label>
          <div class="col-xs-6"><input class="form-control" type="text" name="name" value="{{ old('name') }}" required></div>
      </div>

      <div class="form-group">
      <label for="type" class="col-md-3 control-label">Type:</label>
        <div class="col-xs-6">
          <select name="type" class="form-control" required>
            <option value="" disabled{{ old('type') == '' ? ' selected' : '' }}>Type</option>
            <option value="3"{{ old('type') == 3 ? ' selected' : '' }}>Client</option>
            <option value="2"{{ old('type') == 2 ? ' selected' : '' }}>Operator</option>
            <option value="1"{{ old('type') == 1 ? ' selected' : '' }}>Administrator</option>
          </select>
        </div>
      </div>

      <div class="form-group">
          <label for="email" class="col-md-3 control-label">email:</label>
          <div class="col-xs-6">
            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
@if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
@endif
          </div>
      </div>

      <div class="form-group">
          <label for="password" class="col-md-3 control-label">Password:</label>
          <div class="col-xs-6">
            <input class="form-control" type="password" name="password" required>
@if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
@endif
          </div>
      </div>

      <div class="form-group">
        <label for="password-confirm" class="col-md-3 control-label">Confirm password:</label>
        <div class="col-md-6">
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
      </div>

        <div class="form-group">
          <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Create" required></div>
        </div>
    </form>
  </div>
</div>
@endsection
