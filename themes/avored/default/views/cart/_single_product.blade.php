<form method="post" id="cart-form-update" action="{{ route('cart.update') }}">
    @csrf
    @method('put')
    <tr>
        <td class="col-8">
            <div class="media">
                <img alt="{{ $product->name() }}" class="d-flex mr-3" style="height: 72px;" 
                     src="{{ $product->image()->smallUrl }}"/>

                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="{{ route('product.view', $product->slug())}}">
                            {{ $product->name() }}
                        </a>
                    </h4>

                    <p>Status @if($product->qty() >= 0)
                                    <span class="badge badge-success fill">In Stock</span></p>
                               @else
                                    <span class="badge badge-danger fill">Out of stock</span></p>
                               @endif

                    <?php $attributeText = ""; ?>
                    @if(null !== $product->attributes() && count($product->attributes()))
                        @foreach($product->attributes() as $attribute)
                            @if($loop->last)
                                <?php $attributeText .= $attribute['variation_display_text']; ?>
                            @else
                                <?php $attributeText .= $attribute['variation_display_text'] . ": "; ?>
                            @endif
                        @endforeach
                    @endif
                    <p>Attributes: <span class="text-success"><strong>{{ $attributeText}}</strong></span>
                    </p>

                </div>
            </div>
        </td>

        <td class="col-1">
            <input type="text" class="form-control" name="qty"
                   value="{{ $product->qty() }}">
            <input type="hidden" name="slug" value="{{$product->slug() }}"/>
        </td>

        <td class="col-sm-1 col-1 text-center">
            <strong>{{ $product->priceFormat() }}</strong>
        </td>


        @if(Cart::hasTax())
        <td class="col-sm-1 col-1 text-center">
            <strong>{{ $product->tax() }}</strong>
        </td>
        @endif

        <td class="col-sm-1 col-1 text-center">
            <strong>{{ $product->finalPrice() }}</strong>
        </td>
        <td class="col-sm-1 col-1">
            <div class="btn-group">
                <a class="btn btn-warning" href="#"
                   onclick="jQuery('#cart-form-update').submit()">
                    Update
                </a>
                <button type="button"
                        class="btn dropdown-toggle"
                        data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="btn" href="{{ route('cart.destroy', $product->slug())}}">
                            Remove
                        </a>
                    </li>
                </ul>
            </div>

        </td>

    </tr>
</form>
