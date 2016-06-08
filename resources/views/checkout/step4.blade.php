@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col offset-s3 s6" >
            <form action="/checkout/step5" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h5>Shipping Option</h5>
                            <ul class="collection">
                                 @foreach($shippingMethods as $methodIdentifier => $methodLabel)

                                    <li class="collection-item">
                                        <p>
                                            <input name="shipping_option" value="{{ $methodIdentifier }}" type="radio" id="{{$methodIdentifier}}" />
                                            <label for="{{$methodIdentifier}}">{{ $methodLabel }}</label>
                                        </p>
                                    </li>
                                    @endforeach
                                
                                
                            </ul>

                        </div> <!-- END OF SHIPPING ROW -->
                        <div class="right">
                            <button type="submit">Continue</button>
                        </div>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
