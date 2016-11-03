<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mage2 Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/mage2-admin/css/appscss.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    <style>

        body {
            padding: 0;
            margin: 0;
            list-style: none;

            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .form-group.has-error input {
            border: 1px solid crimson;
            padding: 10px;
        }

        h5 {
            margin: 20px 0px;
        }

    </style>
</head>
<body style="width: 100%;height: 100%;">


<div class="panel panel-primary" style="width: 50%;">
    <div class="panel-heading"><span>Mage2 Admin Login</span></div>
    <div class="panel-body" style="padding: 20px;">

        <form method="POST" action="{{ route('admin.login.post') }}">
            {{ csrf_field(  ) }}

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" class="form-control"
                       value="{{ old('email') }}" autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password"/>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="checkbox">
                <label>
                    <input id="rememberme" type="checkbox" name="remember"/> Remember Me
                </label>
            </div>


            <div class="form-group">

                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                    Forgot Your Password?
                </a>
            </div>

        </form>
    </div>

</div>


<!-- Scripts -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('vendor/mage2-admin/js/all.js') }}"></script>
</body>
</html>
