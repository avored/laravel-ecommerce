@extends('layouts.install')

@section('content')


        <div class="col-md-6">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Welcome to Mage2 Ecommerce Installation</h1>
                    </div>
                    <div class="panel-body">
                            <!--
                             add more extension check list
                             php file info
                            -->
                            
                            

                        <h4 style="text-align: center">Extension Requirement</h4>
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
                            <a href="{{ route('mage2.install.database.table.get') }}" type="submit" class="btn btn-primary">Continue</a>
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