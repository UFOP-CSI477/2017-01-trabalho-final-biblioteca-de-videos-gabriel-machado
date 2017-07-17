@section('navbar-right-login')
<li class="dropdown{{ isset($login_dropdown_hidden) ? '' : ' open' }}">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
  <ul id="login-dp" class="dropdown-menu">
    <li>
      <div class="row">
      <div class="col-md-12">
        <form class="form" role="form" method="post" action="{{ route('login') }}" accept-charset="UTF-8" id="login-nav">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="sr-only" for="email">email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label class="sr-only" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <div class="help-block text-right"><a href="{{ route('password.request') }}">forgot password</a></div>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              keep me logged-in
            </label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
        </form>
      </div>
      <div class="bottom text-center">
          <a href="{{ route('register') }}"><b>Sign in</b></a>
      </div>
      </div>
    </li>
  </ul>
</li>
@stop

@section('navbar-right-user')
@if (Auth::user())
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>{{ Auth::user()->name }}</b> <span class="caret"></span></a>
  <ul id="login-dp" class="dropdown-menu">
    <li>
      <div class="row">
        <div class="col-md-12">
          <form class="form" role="form" method="post"  action="{{ route('logout') }}" accept-charset="UTF-8" id="login-nav">
            {{ csrf_field() }}
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Log out</button>
            </div>
          </form>
        </div>
<!--        <div class="bottom text-center">
          <a href="{{ route('register') }}"><b>Sign in</b></a>
        </div>-->
      </div>
    </li>
  </ul>
</li>
@endif
@stop


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Main</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<!--             <li><a href="{{ url('/') }}">Home</a></li> -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            @yield('navbar-right-login')
          @else
            @yield('navbar-right-user')
          @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    @yield('content')

    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
  </body>
</html>

