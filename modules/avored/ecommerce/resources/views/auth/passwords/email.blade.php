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
<body>
<div id="reset-password-page" class="container-fluid">
<div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-6">
            <div class="offset-1 col-md-10">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-12">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('admin.password.reset.token') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" >E-Mail Address</label>
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                            </div>

                            <div class="form-group">

                                <button type="submit" :disabled="isLoginDisbled" class="btn btn-primary">
                                    Send Password Reset Link
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
<!-- Scripts -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/app.js') }}"></script>
<script>
    var app = new Vue({
        el: '#reset-password-page',
        data : {
            email: ''
        },
        computed: {
            isLoginDisbled: function() {

                if(this.email != "") {
                    return false;
                }

                return true;

            }
        }
    });
</script>

</body>
</html>
