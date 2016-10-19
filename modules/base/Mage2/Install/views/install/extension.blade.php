@extends('layouts.install')

@section('content')

    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card card-default">
                <div class="card-content">
                <div class="card-title">Welcome to Mage2 Ecommerce Installation</div>

                    <h6 class="">Extension Requirement</h6>
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
                            <span>Curl PHP Extension</span>
                            <span class="pull-right">
                                @if($result['curl'] == true)
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
                        <a href="{{ route('mage2.install.database.get') }}" type="submit" class="btn btn-primary">Continue</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .extension-list  div{
            border: 1px solid #ccc;
            padding: 10px;

            margin-bottom: 10px;
        }
    </style>
@endsection