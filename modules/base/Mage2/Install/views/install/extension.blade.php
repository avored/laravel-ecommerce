@extends('mage2install::layouts.install')

@section('content')


    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Welcome to Mage2 Ecommerce Installation</h1>
            </div>
            <div class="panel-body">

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
                        <span>XML PHP Extension</span>
                        <span class="pull-right">
                                @if($result['xml'] == true)
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
                    <button data-url="{{ route('mage2.install.database.table.get') }}"

                            class="btn btn-primary continue-button">Continue
                    </button>
                </div>
            </div>

        </div>
    </div>


    @push('styles')
    <script>
        jQuery(document).ready(function () {
            jQuery('.continue-button').click(function (e) {
                e.preventDefault();
                jQuery(e.target).button('loading');
                location = jQuery(this).attr('data-url');
            });

        });
    </script>
    @endpush
    @push('styles')
    <style>
        .extension-list div {
            border: 1px solid #ccc;
            padding: 10px;

            margin-bottom: 10px;
        }
    </style>
    @endpush
@endsection