@extends('layouts.polymer-app')

@section('content')

    <paper-card heading="Dashboard">
        <div class="card-content">You are logged in !!</div>
        <div class="card-actions">
            <a href="/admin/logout"><paper-button> <iron-icon icon="visibility-off" item-icon></iron-icon> Logout</paper-button></a>
        </div>
    </paper-card>
@endsection
