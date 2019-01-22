<!DOCTYPE html>
<html lang="en">
<head>
    <title>SUST IPC Rank</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <style type="text/css">
        .corner {
            border-radius: 5px;
            padding: 35px;
            box-shadow: 0px 0px 10px;
            margin: 0 auto;
            margin-top: 12%;
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
                    <a class="navbar-brand" href="/">SUST IPC Rank</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up </a>
                    </li>
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="col-md-1"></div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 corner">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form method="post" action="{{ route('login') }}">
                    @csrf


                    <div class="form-group row">
                        <label for="email"
                               class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-7">
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" placeholder="Email" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-7">
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-md-7">
                            <button type="submit" class="btn btn-success">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>


                </form>
            </div>
            <div class="col-md 1"></div>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>


</body>
</html>
