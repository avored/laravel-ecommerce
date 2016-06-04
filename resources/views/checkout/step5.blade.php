@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col offset-s3 s6" >
            <form action="/checkout/step6" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h5>Payment Option</h5>
                        <ul class="collection">
                            <li class="collection-item"><p>
                                    <input name="payment_option" value="internet_banking" type="radio" id="payment_1" />
                                    <label for="payment_1">Internet Banking</label>
                                </p></li>
                            <li class="collection-item"><p>
                                    <input name="payment_option" value="payment_by_cheque" type="radio" id="payment_2" />
                                    <label for="payment_2">Payment By Cheque</label>
                                </p></li>
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
