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
          </tr>
@endforeach
        </tbody>
      </table>
    </div>
  </div>


@endsection

@section('scripts')
<script>
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });

    $('.filterable .filters select').on('change', function(){
        /* Useful DOM data and selectors */
        var $input = $(this);
        if ($input.val() == '') {
            $input.css('color', '#999')
        } else {
            $input.css('color', '#555')
        }
        var inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
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
