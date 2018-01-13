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
    <link href="{{ asset('vendor/mage2-admin/css/bootstrap.min.css') }}" rel="stylesheet">

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
<div class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-8" style="max-width: 650px">
        <div class="card card-default">
            <div class="card-header"><span>Mage2 Admin Login</span></div>
            <div class="card-body" >
                {!! Form::open(['method' => 'post', 'action' => route('admin.login')]) !!}

                {!! Form::text('email','Email Address') !!}
                {!! Form::password('password','Password') !!}

                {!! Form::submit('Login',['disabled' => true, 'class' => 'btn login-button']) !!}
                <a href="{{ route('admin.password.reset') }}">Forgot your password?</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
<!-- Scripts -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('vendor/mage2-admin/js/jquery-3.2.1.min.js') }}"></script>

<script>
    $(function() {
        var timeoutFlag;
        function checkFields() {

            clearTimeout(timeoutFlag);
            var emailFieldValue = jQuery('#email').val();
            var passwordFieldValue = jQuery('#password').val();




            var emailValidationRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if(emailFieldValue != "" && emailValidationRegex.test(emailFieldValue) && passwordFieldValue  != "") {
                jQuery('.login-button').attr('disabled', false);
                jQuery('.login-button').addClass('btn-primary');
            } else {
                jQuery('.login-button').attr('disabled', true);
                jQuery('.login-button').removeClass('btn-primary');
            }
        }
        jQuery(document).on('keyup', '#email , #password', function(e){
            checkFields();
        });

        jQuery(document).on('change', '#email, #password', function(e){
            checkFields();
        });
        timeoutFlag = setTimeout(function(){ checkFields(); }, 100);

    });
</script>
</body>
</html>
