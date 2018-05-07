@extends('avored-ecommerce::layouts.app')
@section('content')
    <div class="container">
        <div class="h1 mb-3">API ACCESS for AvoRed Admin</div>
        <div class="card">
            <div class="card-header">Show API</div>
            <div class="card-body table-bordered">
                <table class="table">
                    <tr>
                        <td>Client Id</td>
                        <td>{{ $client->id }}</td>
                    </tr>
                    <tr>
                        <td>
                            Client Secret
                        </td>
                        <td>
                            {{ $client->secret }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop