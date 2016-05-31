@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col s12">
            <form action="/checkout/place-order" method="post">
                {!! csrf_field() !!}
                
            </form>
            
        </div>
    </div>
</div>
@endsection
