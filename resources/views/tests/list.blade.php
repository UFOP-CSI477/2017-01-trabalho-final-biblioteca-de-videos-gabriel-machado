@extends('tests.main')

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
@if (Auth::user()->type == 1)
          <th><input type="text" class="form-control" placeholder="user"></th>
@endif
          <th><input type="text" class="form-control" placeholder="proc."></th>
@if (Auth::user()->type == 3)
          <th><input type="text" class="form-control" placeholder="price"></th>
@endif
          <th><input type="text" class="form-control" placeholder="date"></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
@foreach ($tests as $p)
@if (Auth::user()->type == 1 or Auth::user()->id == $p->user_id)
        <tr>
          <td>{{ $p->id }}</td>
@if (Auth::user()->type == 1)
          <td>{{ App\User::find($p->user_id)->name }}</td>
@endif
          <td>{{ App\Procedure::find($p->procedure_id)->name }}</td>
@if (Auth::user()->type == 3)
          <td>{{ App\Procedure::find($p->procedure_id)->price }}</td>
@endif
          <td>{{ $p->date }}</td>
          <td>
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <form class="form" role="form" method="post" action="{!! route('tests.destroy', $p->id) !!}" accept-charset="UTF-8" id="login-nav">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" >
                    <button class="btn btn-link" type="submit">Cancel</button>
                  </form>
                </li>
              </ul>
            </div>
          </td>
        </tr>
@endif
@endforeach
      </tbody>
    </table>
  </div>
</div>
@if (Auth::user()->type == 3)
<h3>Total: $ <?php
$sum = 0;
foreach ($tests as $p) {
    if (Auth::user()->id == $p->user_id) {
        $sum += App\Procedure::find($p->procedure_id)->price;
    }
}
echo $sum
?></h3>
@endif

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
