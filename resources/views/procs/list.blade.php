@extends('procs.main')

@section('content')

<div class="row">
  <div class="panel filterable">
    <div class="panel-heading">
        <h3>Procedures</h3>
        <!--<div class="pull-right">
            <button class="btn btn-primary btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
        </div>-->
    </div>

    <table class="table">
      <thead>
        <tr class="filters">
          <th><input type="text" class="form-control" placeholder="#"></th>
          <th><input type="text" class="form-control" placeholder="name"></th>
          <th><input type="text" class="form-control" placeholder="price"></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
@foreach ($procs as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->name }}</td>
          <td>{{ $p->price }}</td>
@if (Auth::user()->type <= 2)
          <td>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <form method="get" action="{{ route('procedures.edit', $p->id) }}">
                    <button class="btn btn-link" type="submit">Edit</button>
                  </form>
                </li>
@if (Auth::user()->type == 1)
                <li>
                  <form class="form" role="form" method="post" action="{!! route('procedures.destroy', $p->id) !!}" accept-charset="UTF-8" id="login-nav">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <button class="btn btn-link" type="submit">Delete</button>
                  </form>
                </li>
@endif
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
