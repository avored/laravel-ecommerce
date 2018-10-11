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
                <th class="text-right">Total (with Tax)</th>
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
                                <?php $attributeText .= $attribute['variation_display_text'] . ': '; ?>
                            @endif
                        @endforeach
                         <p>Attributes:
                            <span class="text-success">
                                 <strong>{{ $attributeText}}</strong>
                            </span>
                         </p>
                    @endif

                    </td>

                    <td class="text-right hidden-xs">{{ $cartItem->qty() }}</td>
                    <td class="text-right hidden-xs">
                        {{ Session::get('currency_symbol') . $cartItem->priceFormat() }}
                    </td>
                    <td class="text-right">
                        {{ Session::get('currency_symbol') . $cartItem->lineTotal() }}
                    </td>
                </tr>

                @php
                    $subTotal = $total = 0;
                    $subTotal += $cartItem->price();
                @endphp

            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="text-right  hidden-xs"><strong>Sub-Total:</strong></td>
                <td class="text-right sub-total"
                        data-sub-total="{{ Cart::total($formate = false) }}">
                    {{ Cart::total() }}</td>
            </tr>
            <tr class="hidden shipping-row">
                <td colspan="3" class="text-right shipping-title  hidden-xs"
                    style="font-weight: bold;">Shipping Option
                </td>
                <td class="text-right shipping-cost" data-shipping-cost="0.00">{{ Session::get('currency_symbol') }}</td>
            </tr>

            <tr>
                <td colspan="3" class="text-right  hidden-xs"><strong>Total:</strong></td>
                <td class="text-right total" data-total="{{ Cart::total($formate = false) }}">
                    {{ Cart::total() }}</td>
            </tr>
            </tfoot>

        </table>
    </div>
    </div>
</div>
