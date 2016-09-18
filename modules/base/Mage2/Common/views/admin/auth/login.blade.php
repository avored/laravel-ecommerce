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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    <style>

        body{
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
        .input-field.has-error input{
            border: 1px solid crimson;
            padding: 10px;
        }
        h5 {
            margin: 20px 0px;
        }

    </style>
</head>
<body style="width: 100%;height: 100%;">


    <div class="card" style="width: 50%;">
        <div class="card-content" style="padding: 20px;">

            <div class="card-title"><h5>Mage2 Admin Login</h5></div>


            <div class="col s12">
            <form method="POST" action="{{ route('admin.login.post') }}">
                {{ csrf_field(  ) }}

                <div class="input-field {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" >E-Mail Address</label>
                    <input id="email" type="email"  name="email"
                           value="{{ old('email') }}"  autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" >Password</label>
                    <input id="password" type="password"  name="password" />

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="input-field">
                    <p>
                        <input id="rememberme" type="checkbox" name="remember"/>
                        <label for="rememberme">Remember Me</label>
                    </p>
                </div>


                <div class="input-field">

                    <button type="submit" class="btn btn-primary">
                        Login
                    </button>

                    <!--a class="btn btn-link" href="{{ url('/admin/password/reset') }}">
                                    Forgot Your Password?
                                </a-->
                </div>

            </form>
            </div>
        </div>
    </div>


<!-- Scripts -->
<!-- JQuery -->
<script src="{{ asset('/js/jquery.js') }}"></script>
    <script src="{{ asset('/js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
