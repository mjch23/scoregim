<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ScoreGim</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="{{ asset('js/all.js') }}"></script>

    <!-- Fonts -->

    <link rel="stylesheet" href="{{ asset('css/all.js') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
           <div class="container">


                <a class="navbar-brand text-danger" href="{{ url('/') }}">ScoreGim
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

@guest


@else
                    @if(Auth::user()->hasRole('admin'))
                             <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('gimnastas.index')}}">Gimnastas <span class="sr-only">(current)</span></a>
                                  </li>

                             <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('rotacion.index')}}">Rotaciones <span class="sr-only">(current)</span></a>
                                  </li>

                             <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('resultado.index')}}">Resultados <span class="sr-only">(current)</span></a>
                                  </li>

                              <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('configuracion.index')}}">Configuracion <span class="sr-only">(current)</span></a>
                                  </li>

                                  @endif



                    @if(Auth::user()->hasRole('Salto')||Auth::user()->hasRole('admin'))                                  
                          
                                  <li class="nav-item">
                                     <a class="nav-link" href="{{ route('salto.index')}}">Salto</a>                                  
                                  </li>

                                  @endif


                    @if(Auth::user()->hasRole('Suelo')||Auth::user()->hasRole('admin'))                                     

                                    <li class="nav-item">
                                    <a class="nav-link" href="{{ route('suelo.index')}}">Suelo</a>                                  
                                  </li>

                                  @endif


                    @if(Auth::user()->hasRole('Viga')||Auth::user()->hasRole('admin'))   

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('viga.index')}}">Viga</a>                                  
                                  </li>

                                  @endif


                    @if(Auth::user()->hasRole('Barras')||Auth::user()->hasRole('admin'))   

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('barras.index')}}">Barras Paralelas</a>
                                  </li>

                                  @endif
  @endguest



                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

       <main class="py-4"> 

    <div class="container" style="margin-top: 25px">

            @yield('content')

                </div>
    <style type="text/css">
    .table {
        border-top: 2px solid #ccc;

    }
    </style>

      </main> 
    </div>
</body>
</html>

