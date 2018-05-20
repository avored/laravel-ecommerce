<div class="card mb-3">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <div class="table-responsive">
        <table id="cart_table" class="table table-bordered table-hover ">
            <thead>
            <tr>
                <th class="text-left">Product Name</th>
                <th class="text-right hidden-xs">Quantity</th>
                <th class="text-right hidden-xs">Unit Price</th>
                <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody>
            @php
                $subTotal = 0;$totalTax = 0;
            @endphp
            @foreach($cartItems as $cartItem)
                <tr>
                    <td class="text-left">
                        {{ $cartItem->name() }}

                        <br>
                        &nbsp;

                        @if(null !== $cartItem->attributes() && count($cartItem->attributes()))
                        @php
                            $attributeText = "";
                        @endphp
                        @foreach($cartItem->attributes() as $attribute)
                            @if($loop->last)
                                <?php $attributeText .= $attribute['variation_display_text']; ?>
                            @else
                                <?php $attributeText .= $attribute['variation_display_text'] . ": "; ?>
                            @endif
                        @endforeach
                         <p>Attributes: <span
                                class="text-success"><strong>{{ $attributeText}}</strong></span>
                    @endif

                    </td>

                    <td class="text-right hidden-xs">{{ $cartItem->qty() }}</td>
                    <td class="text-right hidden-xs">
                        ${{ $cartItem->priceFormat()  }}</td>
                    <td class="text-right">
                        ${{ $cartItem->finalPrice()  }}</td>
                </tr>

                @php
                    $subTotal = $total = 0;
                    $subTotal += $cartItem->price();
                @endphp
                <input type="hidden" name="products[]" value="{{ $cartItem->slug() }}"/>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right  hidden-xs"><strong>Sub-Total:</strong></td>
                <td class="text-right sub-total" data-sub-total="{{ number_format((float)$subTotal, 2, '.', '') }}">
                    ${{ number_format((float)$subTotal, 2, '.', '') }}</td>
            </tr>
            <tr class="hidden shipping-row">
                <td colspan="3" class="text-right shipping-title  hidden-xs"
                    style="font-weight: bold;">Shipping Option
                </td>
                <td class="text-right shipping-cost" data-shipping-cost="0.00">$</td>
            </tr>

            <tr>
                <td colspan="3" class="text-right  hidden-xs"><strong>Total:</strong></td>
                <td class="text-right total" data-total="{{ number_format((float)$subTotal, 2, '.', '') }}">
                    ${{ number_format((float)$subTotal, 2, '.', '') }}</td>
            </tr>
            </tfoot>

        </table>
    </div>
    </div>
</div>
