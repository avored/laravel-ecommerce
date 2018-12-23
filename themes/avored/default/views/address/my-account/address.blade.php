@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')

<h3>{{ __('addresses.title') }}</h3>   
    @if(count($addresses) <= 0)
        <p>{{ __('addresses.no_data') }}</p>
        <a class="btn btn-primary" href="{{ route('my-account.address.create')}}">{{ __('addresses.create') }}</a>
    @else
        <div class="row">
            @foreach($addresses as $address)
                <div class="col-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            @if($address->type == "SHIPPING")
                                <span>{{ __('orders.shipping_address') }}</span>
                            @else
                                <span>{{ __('orders.billing_address') }}</span>
                            @endif

                           <span class="float-right">
                            <a href="{{ route('my-account.address.edit', $address->id)}}">{{ __('addresses.edit') }}</a>
                            </span>
                        </div>
                        
                        <div class="card-body ">
                            <form>
                                <div class="form-group">
                                    <label for="inputAddress">{{ __('customer.address') }}</label>
                                    <input type="text" class="form-control" id="inputAddress" value="{{ $address->address1}}" disabled="">
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress2">{{ __('customer.address2') }}</label>
                                    <input type="text" class="form-control" id="inputAddress2" value="{{ $address->address2}}" disabled="">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">{{ __('customer.postalcode') }}</label>
                                        <input type="text" class="form-control" id="inputCity" value="{{ $address->postcode}}" disabled="">
                                    </div>                                    

                                    <div class="form-group col-md-8">
                                        <label for="inputCity">{{ __('customer.city') }}</label>
                                        <input type="text" class="form-control" id="inputCity" value="{{ $address->city}}" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">{{ __('customer.state') }}</label>
                                    <input type="text" class="form-control" id="inputZip" value="{{ $address->state}}" disabled="">
                                </div>

                                <div class="form-group">
                                    <label for="country">{{ __('customer.country') }}</label>
                                    <input type="text" class="form-control" id="country" value="{{ $address->country->name}}" disabled="">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endsection