@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="bg-primary panel widget ">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                        <em class="glyphicon glyphicon-user" style="font-size: 50px"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $totalRegisteredUser }}</div>
                        <div class="text-uppercase">TOTAL No Of Users</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-danger panel widget ">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-danger-dark pv-lg">
                        <em class="glyphicon glyphicon-warning-sign" style="font-size: 50px"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $totalPendingOrders }}</div>
                        <div class="text-uppercase">No Of Pending Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-warning panel widget ">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-warning-dark pv-lg">
                        <em class="glyphicon glyphicon-road" style="font-size: 50px"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $totalReceivedOrders }}</div>
                        <div class="text-uppercase">No of Received Orders</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection