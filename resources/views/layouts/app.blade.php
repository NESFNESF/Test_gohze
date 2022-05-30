<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->


    <!-- Styles -->
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/size.css') }}" rel="stylesheet">
    <link href="{{ asset('css/text.css') }}" rel="stylesheet">
    <link href="{{ asset('style/bootstrap4/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">




        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">TEST GOHZE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">




              @guest
              @if (Route::has('login'))
                  <li class="navbar-text">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li class="navbar-text">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else

 <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/test1">Test 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/test2">Test 2</a>
                  </li>


              </ul>

  <li class="navbar-text dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
                  </div>
                </li>

                @endguest

            </div>
          </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('style/bootstrap4/dist/js/jquery3.min.js') }}" ></script>
    <script src="{{ asset('style/bootstrap4/dist/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('style/bootstrap4/dist/js/bootstrap.bundle.js') }}" ></script>
</body>

</html>
