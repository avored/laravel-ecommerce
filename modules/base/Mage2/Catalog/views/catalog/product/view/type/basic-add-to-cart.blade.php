{!! Form::open(['method' => 'get','action' => route('cart.add-to-cart', $product->id)]) !!}
<div class="product-stock">In Stock</div>
<hr>
<div class="row">
    <div class="form-group col-md-1" style="">
        <label>Qty</label>
        <input type="text" name="qty" class="form-control" value="1"/>
    </div>
</div>
<div class="clearfix"></div>
<div class="pull-left" style="margin-right: 5px;">
    <button type="submit" class="btn btn-primary"
            href="{{ route('cart.add-to-cart', $product->id) }}">
        Add to Cart
    </button>
</div>
{!! Form::close() !!}