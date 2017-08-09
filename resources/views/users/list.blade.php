@extends('users.main')

@section('content')

<div class="row">
  <div class="panel filterable">
    <div class="panel-heading">
        <h3>Users</h3>
        <!--<div class="pull-right">
            <button class="btn btn-primary btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>-->
    </div>

    <table class="table">
      <thead>
        <tr class="filters">
          <th><input type="text" class="form-control" placeholder="#"></th>
          <th><input type="text" class="form-control" placeholder="name"></th>
          <th>
            <select class="form-control">
              <option value="">type</option>
              <option value="Administrator">Administrator</option>
              <option value="Operator">Operator</option>
              <option value="Patient">Patient</option>
            </select>
          </th>
          <th><input type="text" class="form-control" placeholder="email"></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
@foreach ($users as $u)
        <tr>
          <td>{{ $u->id }}</td>
          <td>{{ $u->name }}</td>
          <td><?php
switch($u->type) {
    case 1: echo 'Administrator'; break;
    case 2: echo 'Operator'; break;
    case 3: echo 'Patient'; break;
}
          ?></td>
          <td>{{ $u->email }}</td>
@if (Auth::user()->type == 1)
          <td>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <form class="form" role="form" method="post" action="{!! route('users.destroy', $u->id) !!}" accept-charset="UTF-8" id="login-nav">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <button class="btn btn-link" type="submit">Delete</button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
@endif
        </tr>
@endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('css/list.js') }}"></script>
@endsection

@section('styles')
<style>
.filters select {
    color: #999;
}

select option {
    color: #555;
}
</style>
@endsection
