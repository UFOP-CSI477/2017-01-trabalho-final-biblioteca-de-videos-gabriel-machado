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
          <div class="col-xs-3"><label for="name">Name:</label></div>
          <div class="col-xs-6"><input class="form-control" type="text" name="name" required></div>
      </div>

      <div class="form-group">
      <div class="col-xs-3"><label for="type">Type:</label></div>
        <div class="col-xs-6">
          <select name="type" class="form-control" required>
            <option value="" disabled selected>Type</option>
            <option value="3">Client</option>
            <option value="2">Operator</option>
            <option value="1">Administrator</option>
          </select>
        </div>
      </div>

      <div class="form-group">
          <div class="col-xs-3"><label for="email">email:</label></div>
          <div class="col-xs-6"><input class="form-control" type="email" name="email" required></div>
      </div>

      <div class="form-group">
          <div class="col-xs-3"><label for="password">Password:</label></div>
          <div class="col-xs-6"><input class="form-control" type="password" name="password" required></div>
      </div>

        <div class="form-group">
          <div class="col-xs-2 col-md-offset-7"><input class="form-control btn-primary" type="submit" value="Create" required></div>
        </div>
    </form>
  </div>
</div>
@endsection
