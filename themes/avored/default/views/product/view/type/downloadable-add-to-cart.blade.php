
@if(isset($product->downloadable) && $product->downloadable->demo_path != "")
<div class="demo-downloadable">
    <a href="{{ route('product.demo.download') }}" onclick="event.preventDefault();
                                                     document.getElementById('download-demo-product-media').submit();">
        Download Demo Media
    </a>
    <form id="download-demo-product-media" method="post" action="{{ route('product.demo.download') }}">
        @csrf()
        <input type="hidden" name="product_token" value="{{ $product->downloadable->token }}" />
    </form>
</div>

@else

<div class="demo-downloadable">
    <a href="#">
        Sorry Demo is not available
    </a>
    
</div>

@endif

@if($product->qty >= 0)

<form method="post" action="{{ route('cart.add-to-cart') }}">
    @csrf()
<input type="hidden" name="slug" value="{{ $product->slug }}"/>
<div class="product-stock">In Stock</div>
<hr>
<div class="row">
    <div class="form-group col-md-2" style="">
        <label>Qty</label>
        <input type="number" name="qty" class="form-control" value="1"/>
    </div>
</div>
<div class="clearfix"></div>
<div class="float-left" style="margin-right: 5px;">
    <button type="submit" class="btn btn-primary"
            href="{{ route('cart.add-to-cart', $product->id) }}">
        Add to Cart
    </button>
</div>
</form>


@else
    <div class="product-stock text-danger">Out of  Stock</div>
    <hr>
    <div class="row">
        <div class="form-group col-md-2" style="">
            <label>Qty</label>
            <input type="text" disabled="" name="qty" class="form-control" value="1"/>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="float-left" style="margin-right: 5px;">
        <button type="button"  disabled class="btn btn-default"
                href="#">
            Add to Cart
        </button>
    </div>


@endif


