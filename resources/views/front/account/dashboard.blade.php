@extends('mage2::front.master')

@section('content')
    <h1>User Dashboard</h1>
    <div class="row">

        @include('mage2::front.account._menu')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">User Dashboard</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <p>User Order List Panel</p>
                    </div>
                    <div class="col-md-6">
                        <p>User Address List Panel</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection