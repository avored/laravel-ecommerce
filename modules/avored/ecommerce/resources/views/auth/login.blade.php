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
<div id="login-page" class="container-fluid">
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-6">
            <div class="offset-1 col-md-10">
            <div class="card">

                <div class="card-header bg-primary text-white">
                    {{ __('avored-ecommerce::lang.admin-login-card-title') }}
                </div>
                <div class="card-body" >

                    <form method="post" action="{{ route('admin.login') }}" >
                        @csrf

                        <avored-form-input 
                            field-name="email"
                            label="{{ __('avored-ecommerce::lang.admin-email-label') }}" 
                            error-text="{!! $errors->first('email') !!}"
                            v-on:change="changeModelValue"
                            autofocus="autofocus"
                                >
                        </avored-form-input>

                        <avored-form-input 
                            field-name="password"
                            label="Password" 
                            field-type="password"
                            error-text="{!! $errors->first('password') !!}"
                            v-on:change="changeModelValue"
                                >
                        </avored-form-input>

                        <div class="form-group">

                            <button type="submit" :disabled='isLoginDisbled'  class="btn btn-primary">
                                {{ __('avored-ecommerce::lang.admin-login-button-title') }}
                            </button>

                            <a href="{{ route('admin.password.reset') }}">
                                {{ __('avored-ecommerce::lang.admin-login-forget-password-link') }}
                            </a>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="col-6" style="border-left:1px solid;height:100vh;background-color:brown">
            
        </div>
    </div>
</div>
<!-- Scripts -->
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/app.js') }}"></script>

<script >
    var app = new Vue({
        el: '#login-page',
        data : {
            email: '',
            password: '',
            autofocus:true
        },
        computed: {
            isLoginDisbled: function() {
                if(this.email != "" && this.password != "") {
                    return false;
                }
                return true;
            }
        },
        methods: {
            changeModelValue: function(val,fieldName) {
                this[fieldName] = val;
            }
        }
    });
</script>

</body>
</html>
