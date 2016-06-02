@extends('layouts.front.app')

@section('content')
<p>&nbsp;</p>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s4"><a href="#my-account">MY Account</a></li>
            <li class="tab col s4"><a class="active"   href="#address">Address</a></li>
            <li class="tab col s4"><a href="#order">Order</a></li>
        </ul>
    </div>
    <div id="my-account" class="col s12">
        <h2>My Account</h2>
        <div class="right"><a href="/my-account/edit" class="btn btn-default">Edit</a></div>
        <table>
            <tbody>
            <tr><th>First Name</th><td>{{ $customer->first_name }}</td></tr>
            <tr><th>Last Name</th><td>{{ $customer->last_name }}</td></tr>
            <tr><th>Email</th><td>{{ $customer->email }}</td></tr>
            </tbody>
        </table>


    </div>
    <div id="address" class="col s12">
        <h2>Address</h2>
        <form action="/my-account/address" method="POST">
            <div class="input-field">
                <input type="text" name="first_name" value=""  />
                <label>First Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="last_name" value=""  />
                <label>Last Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="address_1" value=""  />
                <label>Address 1</label>
            </div>
            <div class="input-field">
                <input type="text" name="address_2" value=""  />
                <label>Address 2</label>
            </div>
            <div class="input-field">
                <select name="country_id">
                    <option value="1">New Zealand</option>
                </select>
                <label>Country</label>
            </div>
            <div class="input-field">
                {{ csrf_field() }}
                <button name="create" type="submit">Create</button>
            </div>

        </form>
    </div>
    <div id="order" class="col s12">
        <h2>Order</h2>
        @foreach($customer->orders as $order)
            <div class="col s4">


                <div class="card">
                    <div class="card-content">
                        {{$order->payment_option }} <br/>
                        {{$order->shipping_option}} <br/>

                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection
