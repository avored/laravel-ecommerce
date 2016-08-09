@extends('layouts.install')

@section('content')

    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default panel-installation">
                <div class="panel-heading">Welcome to Crazy Ecommerce Installation</div>
                <div class="panel-body">
                    <h2 class="">Extension Requirement</h2>

                    <div class="extension-list">
                        <div>
                            <span>OpenSSL PHP Extension</span>
                            <span class="pull-right">
                                @if($result['openssl'] == true)
                                    <i class="glyphicon glyphicon-ok glyphicon "></i>
                                @else
                                    <i class="glyphicon glyphicon-remove glyphicon "></i>
                                @endif
                            </span>
                        </div>
                        <div>
                            <span>PDO PHP Extension</span><span class="pull-right">
                                @if($result['pdo'] == true)
                                    <i class="glyphicon glyphicon-ok glyphicon "></i>
                                @else
                                    <i class="glyphicon glyphicon-remove glyphicon "></i>
                                @endif
                            </span>
                        </div>
                        <div>
                            <span>Mbstring PHP Extension</span><span class="pull-right">
                                @if($result['mbstring'] == true)
                                    <i class="glyphicon glyphicon-ok glyphicon "></i>
                                @else
                                    <i class="glyphicon glyphicon-remove glyphicon "></i>
                                @endif
                            </span>
                        </div>
                        <div>
                            <span>Tokenizer PHP Extension</span><span class="pull-right">
                                @if($result['tokenizer'] == true)
                                    <i class="glyphicon glyphicon-ok glyphicon "></i>
                                @else
                                    <i class="glyphicon glyphicon-remove glyphicon "></i>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="">
                        <a href="{{ route('crazy.install.database.get') }}" type="submit" class="btn btn-primary">Continue</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .extension-list  div{
            border: 1px solid #ccc;
            padding: 10px;
            background: #00b3ee;
            margin-bottom: 10px;
        }
    </style>
@endsection