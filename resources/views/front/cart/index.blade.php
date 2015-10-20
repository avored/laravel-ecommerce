@extends('front.master')

@section('content')

    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">
                <div class="row">
                    <div class="col-xs-6">
                        <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                    </div>
                    <div class="col-xs-6">
                        <a href="{!! url('/') !!}" type="button" class="btn btn-primary btn-sm btn-block">
                            <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
             <?php $total = 0 ?>
            @if(count($cart) == 0)
            <div class="row">
                <p>Sorry Your Cart is Empty</p>
                <p>
                    <a title="Continue Shopping" href="{!! url('/')  !!}">Continue Shopping</a>
                </p>
            </div>
            @else 
                {!! Form::open(array('url' => url('/cart/updatecartitem/'),
                                       'method' => 'post' , 'class' => 'updatecartitemForm')) !!}
                                       
                @foreach($cart as $item)
                
                <?php $total += $item['qty'] * $item['price']->first()->sale_price; ?>
                <div class="row">
                        
                    <div class="col-xs-2"><img class="img-responsive" width="100" src="{!! url($item['image']) !!}">
                    </div>
                    <div class="col-xs-4">
                        <h4 class="product-name"><strong>{!! $item['name'] !!}</strong></h4>
                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-6 text-right">
                            <h6><strong><?php echo $item['price']->first()->sale_price ?><span class="text-muted">x</span></strong></h6>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="qty[{!! $item['id'] !!}]" class="form-control input-sm" value="{!! $item['qty'] !!}">
                        </div>
                        <div class="col-xs-2">
                            
                            <button type="button"  
                                    class="btn btn-link btn-xs ajaxrequest glyphicon glyphicon-trash" 
                                    data-callback="reload",
                                    data-token="{!! csrf_token() !!}"
                                    data-url="{!! url('/cart/deletecartitem/'. $item['id']) !!}">
                                
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
                {!! Form::close() !!}
            @endif


            <div class="row">
                <div class="text-center">
                    <div class="col-xs-9">
                        <h6 class="text-right">Added items?</h6>
                    </div>
                    <div class="col-xs-3">
                        <button onclick="jQuery('.updatecartitemForm').submit()" type="button" class="btn btn-default btn-sm btn-block">
                            Update cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row text-center">
                <div class="col-xs-9">
                    <h4 class="text-right">Total <strong>${{ $total }}</strong></h4>
                </div>
                <div class="col-xs-3">
                    <a href="{!! url('/checkout') !!}" title="Checkout" class="btn btn-success btn-block">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection