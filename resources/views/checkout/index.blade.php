@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col offset-s3 s6" >
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Checkout As</span>
                    <div class="clearfix"></div>
                    <div class="input-field">
                        <input type="radio" id="guest_customer_radio" onclick="jQuery('.password_field').toggle();" checked="true" name="checkout_type" value="customer" />
                        <label for="guest_customer_radio">Create Account</label>
                    </div>
                    <div class="input-field">
                        <input id="guest_checkout_radio" onclick="jQuery('.password_field').toggle();" type="radio" name="checkout_type" value="guess" />
                        <label for="guest_checkout_radio">Checkout as Guest</label>
                    </div>
                    <div class="right">
                        <a href="#" class="btn btn-primary">Continue</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
