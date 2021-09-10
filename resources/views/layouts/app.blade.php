<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Event Backend</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">       
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="events/index.html">Primer Prueba</a>
            <!-- Authentication Links -->
                @guest
                        <ul class="navbar-nav ml-auto">
                                <li class="nav-item mr-5">
                                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                        </ul>            
                        @else
                        <span class="navbar-organizer w-100">{{Auth::user()->name}}</span>

                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item dropdown mr-5">
                                

                                    <a class="dropdown-item" style="color:white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                        @endguest
        </nav>

        @if(Session::has('message_type') && Session::has('message'))
            <div class="container mt-5 pt-5" style="z-index: 1001;position:relative;">
                <div class="alert alert-{{Session::get('message_type')}}">
                    {{Session::get('message')}}
                </div>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
