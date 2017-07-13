@extends('main')

@section('content')

<h1>Register</h1>

<form method="post" action="/user">

  {{ csrf_field() }}

    Name: <input type="text" name="name"><br>
    email: <input type="text" name="email"><br>
    Password: <input type="password" name="password"><br>

    <select name="type">
    <option value="" disabled selected>Type</option>

    <option value="3">Client</option>
    <option value="2">Operator</option>
    <option value="1">Administrator</option>

  </select>

  <input type="submit" value="Continue">
</form>

@endsection
