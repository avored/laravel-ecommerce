<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AvoRed Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/avored-admin/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
</head>
<body >
<div id="admin-password-reset-page" class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-6">
            <div class="offset-1 col-10">
                <div class="card">
                    <div class="card-header">Reset Password</div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" method="POST"
                                action="{{ route('admin.password.email.post') }}">
                                @csrf

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">E-Mail Address</label>
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input v-model="password" id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input v-model="password_confirmation" id="password-confirm"
                                        type="password" class="form-control"
                                        name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <button :disabled='isLoginDisbled' type="submit" class="btn btn-primary">
                                        Reset Password
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6" style="border-left:1px solid;height:100vh;background-color:brown">
            
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/app.js') }}"></script>
<script>
    var app = new Vue({
        el: '#admin-password-reset-page',
        data : {
            email: '',
            password: '',
            password_confirmation: ''
        
        },
        computed: {
            isLoginDisbled: function() {

                if(this.email != "" && this.password != "" && this.password_confirmation != "" && this.password == this.password_confirmation)  {
                    return false;
                }
                return true;

            }
        }
    });
</script>

</body>

</html>
