<!doctype html>
<html>
<head>
    <meta charset="utf-8">


    <style>
        /**
            .invoice-box{
                max-width:800px;
                margin:auto;
                padding:30px;
                border:1px solid #eee;
                box-shadow:0 0 10px rgba(0, 0, 0, .15);
                font-size:16px;
                line-height:24px;
                font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color:#555;
            }

            .invoice-box table{
                width:100%;
                line-height:inherit;
                text-align:left;
            }


            .invoice-box table td{
                padding:5px;
                vertical-align:top;
            }

            .invoice-box table tr td:nth-child(2){
                text-align:center;
            }

            .invoice-box table tr.top table td{
                padding-bottom:20px;
            }

            .invoice-box table tr.top table td.title{
                font-size:45px;
                line-height:45px;
                color:#333;
            }

            .invoice-box table tr.information table td{
                padding-bottom:40px;
            }

            .invoice-box table tr.heading td{
                background:#eee;
                border-bottom:1px solid #ddd;
                font-weight:bold;
            }

            .invoice-box table tr.details td{
                margin-bottom:20px;
            }

            .invoice-box table tr.item td{
                border-bottom:1px solid #eee;
            }

            .invoice-box table tr.item.last td{
                border-bottom:none;
            }

            .invoice-box table tr.total td:nth-child(2){
                border-top:2px solid #eee;
                font-weight:bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td{
                    width:100%;
                    display:block;
                    text-align:center;
                }

                .invoice-box table tr.information table td{
                    width:100%;
                    display:block;
                    text-align:center;
                }
                .right-align {
                    text-align: right;
                }
            }
            h6 {
                margin: 0px 10px;
            }

    */
    </style>
</head>

<body>
<div style="width:100%">
    <div style="font-weight: bold; font-size: 22px;display:inline-block;width: 50%">
        Mage2 Ecommerce
    </div>

    <div style="display:inline-block;width: 49%;text-align:right">
        Order # : {{ $order->id }} <br/>
        Company Address1<br/>
        Company Address 2 <br/>
        State<br/>
        Country</br>
    </div>

</div>

<div style="width:100%">
    <div style="display:inline-block;width: 49%;text-align:left">
        <?php $shippingAddress = $order->shipping_address ?>
        <h4>Shipping Address </h4>
        {{ $shippingAddress->address1 }}<br/>
        {{ $shippingAddress->address2 }}<br/>
        {{ $shippingAddress->area }}<br/>
        {{ $shippingAddress->city }}<br/>
        {{ $shippingAddress->state }}<br/>
        {{ $shippingAddress->counry }}<br/>

    </div>
    <div style="display:inline-block;width: 49%;text-align:left">
        <?php $billingAddress = $order->billing_address ?>
        <h4>Billing Address </h4>
        {{ $billingAddress->address1 }}<br/>
        {{ $billingAddress->address2 }}<br/>
        {{ $billingAddress->area }}<br/>
        {{ $billingAddress->city }}<br/>
        {{ $billingAddress->state }}<br/>
        {{ $billingAddress->counry }}<br/>
    </div>
</div>


<div style="height:50px">

</div>

<div style="width:100%">
    <table style="width: 100%">
        <tr>
            <th style="text-align:left"> Title</th>
            <th style="text-align:left"> Price</th>
            <th style="text-align:left"> Qty</th>
            <th style="text-align:left"> Total</th>
        </tr>

        @foreach($order->products as $product)


            <tr>
                <td>
                    {{ $product->title }}
                </td>

                <td>
                    ${{ $product->getRelationValue('pivot')->price }}
                </td>
                <td>
                    {{ $product->getRelationValue('pivot')->qty }}
                </td>
                <td>
                    {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }}
                </td>
            </tr>

        @endforeach

    </table>
</div>


<!--
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table class="company_info">
                    <tr>
                        <td class="title">
                            <h6>Mage2 Ecommerce</h6>
                        </td>
                       

                        <td class="right-align">
                            ORDER #: {{ $order->id }}<br>
                            Created: {{ $order->created_at }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            Next Step Webs, Inc.<br>
                            12345 Sunny Road<br>
                            Sunnyville, TX 12345
                        </td>

                        <td class="right-align">
                            Acme Corp.<br>
                            John Doe<br>
                            john@example.com
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td >
                Payment Method
            </td>

            <td>
                {{ $order->payment_method  }}
        </td>
        <td >
            Shipping Method
        </td>

        <td>
            {{ $order->shipping_method }}
        </td>
    </tr>



    <tr  class="details">
        <td >&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr class="heading">
            <td>
                Product
            </td>
            <td>
                Unit Price
            </td>

            <td>
                Qty
            </td>
            <td>
                Price
            </td>
        </tr>


        @foreach($order->products as $product)


    <tr class="item">
        <td>
            {{ $product->title }}
            </td>

            <td>
                ${{ $product->getRelationValue('pivot')->price }}
            </td>
            <td>
                {{ $product->getRelationValue('pivot')->qty }}
            </td>
            <td>
                {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }}
            </td>
        </tr>

        @endforeach


        <tr class="total">
            <td></td>
            <td></td>
            <td></td>

            <td >
                Total: $385.00
            </td>
        </tr>
    </table>

</div>
-->
</body>
</html>