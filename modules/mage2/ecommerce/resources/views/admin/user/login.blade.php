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
    <link href="{{ asset('vendor/mage2-admin/css/app.css') }}" rel="stylesheet">

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
        <div class="card">

            <div class="card-header bg-primary text-white">
                {{ __('mage2-ecommerce::lang.admin-login-card-title') }}
            </div>
            <div class="card-body" >

                <form method="post" action="{{ route('admin.login') }}" >
                    {{ csrf_field() }}

                    @include('mage2-ecommerce::forms.text',
                                ['name' => 'email',
                                'label' => __('mage2-ecommerce::lang.admin-email-label')
                                ])
                    @include('mage2-ecommerce::forms.password',[
                                    'name' => 'password',
                                    'label' => __('mage2-ecommerce::lang.admin-password-label')
                                    ])

                    <div class="form-group">

                        <button type="submit" class="btn btn-primary">
                            {{ __('mage2-ecommerce::lang.admin-login-button-title') }}
                        </button>

                        <a href="{{ route('admin.password.reset') }}">
                            {{ __('mage2-ecommerce::lang.admin-login-forget-password-link') }}
                        </a>
                    </div>

                </form>
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

        jQuery('.login-button').attr('disabled',true);
        jQuery('#email').focus();
    });
</script>
</body>
</html>
