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

                            <avored-form-input 
                                field-name="email"
                                label="{{ __('avored-ecommerce::lang.admin-email-label') }}" 
                                error-text="{!! $errors->first('email') !!}"
                                v-on:change="changeModelValue"
                                autofocus="autofocus"
                                    >
                            </avored-form-input>

                            <div class="form-group">
                               
                                <button 
                                    type="submit" 
                                    :disabled='isSendPasswordSubmitDisbled'  
                                    class="btn btn-primary">
                                    {{ __('avored-ecommerce::lang.admin-reset-button-title') }}
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
            email: '',
            autofocus:true
        },
        computed: {
            isSendPasswordSubmitDisbled: function() {
                if(this.email != "") {
                    return false;
                }
                return true;
            }
        },
        methods: {
            changeModelValue: function(val,fieldName) {
    
                if(fieldName == "email") {
                    this.email = val;
                }
            }
        }
    });
</script>

</body>
</html>
