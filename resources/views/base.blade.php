<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- jquery cdn -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">


    <!-- moj css -->
    <link rel="stylesheet" href="/css/theme.css">

    <title>Invoice Manager - @yield('title')</title>
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav_zg">
                <span class=" glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <a href="/" class="navbar-brand">Invoice Manager</a>
        </div>

        <div class="collapse navbar-collapse" id="nav_zg" >
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Domov</a></li>
                <li><a href="{{ route('instructions') }}">Navodila</a></li>
                @if(Auth::guest())
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Gost <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/login') }}">Prijava</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('invoices') }}">Računi</a></li>
                    <li><a href="{{ route('items') }}">Izdelki</a></li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ url('/logout') }}">Odjava</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- konec navigacije zgoraj  -->
<!-- vsebina -->
<div class="container">
    <!-- glavni naslov strani -->
    <div class="page-header text-center">
        <h1> @yield('page-heading')</h1>
    </div>

<!-- ostala redirect obvesxtila  -->
    @if(session('status'))
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="alert alert-success">
                    <p>
                        <span class="glyphicon glyphicon-check"></span>
                        {{session('status')}}
                    </p>
                </div>
            </div>
        </div>
    @endif
<!-- vsebina -->
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</body>
</html>