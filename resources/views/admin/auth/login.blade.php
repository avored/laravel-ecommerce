<!doctype html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{!! asset('/css/libs/bootstrap.min.css') !!}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Open Sans', sans-serif;
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
            width: 40%;
        }

        .mage2logo {
            max-height: 100px;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="content">
        <div id="loginbox">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title text-center">
                        <img src="{{ asset('images/mage2-logo.png') }}" class="mage2logo" alt="Mage2 "
                             title="http://mage2.website/"/>
                    </div>
                </div>

                <div class="panel-body">

                    <form name="form" id="form" enctype="multipart/form-data" action="{!! url('/admin/login') !!}" method="POST">
                        {!! Form::token() !!}
                        <div class="form-group">
                            {!! Form::text('email',null,['class' => 'form-control','placeholder'=>'Email']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::password('password',['class' => 'form-control','placeholder'=>'Password']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Login',['class' => 'btn btn-primary pull-right']) !!}
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>