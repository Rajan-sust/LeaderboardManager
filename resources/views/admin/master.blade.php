<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUST IPC Rank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .nav-collapse {
            margin-left: 2px;
        }
        #myInput {
            background-image: url("https://www.w3schools.com/howto/searchicon.png");
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 2px solid #ddd;
            margin-bottom: 12px;

        }
        .corner {
            border-radius: 5px;
            padding: 35px;
            box-shadow: 0px 0px 10px;
            text-align: center;
        }

    </style>
</head>
<body>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/home">SUST IPC Rank</a>
                </div>

                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Add Contest</a></li>
                </ul>

                <ul class="nav navbar-nav nav-collapse">
                    <li class="active"><a href="#">Set Point</a></li>
                </ul>

                <ul class="nav navbar-nav nav-collapse">
                    <li class="active"><a href="#">Experimental Merge</a></li>
                </ul>

                <ul class="nav navbar-nav nav-collapse">
                    <li class="active"><a href="#">Publish Rank</a></li>
                </ul>
                <ul class="nav navbar-nav nav-collapse">
                    <li class="active"><a href="#">Permit Admin</a></li>
                </ul>



                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }} <span class="caret"></span>
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
        </nav>
    </div>
    <div class="col-md-1"></div>
</div>
</body>
