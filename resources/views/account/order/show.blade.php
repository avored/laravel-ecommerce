@extends('layouts.user')

@section('breadcrumb')
<div class="bg-gray-200 p-3 rounded text-sm mb-5">
    <ol class="list-reset flex text-gray-700">
       <li>
            <a class="text-gray-700" href="{{ route('home') }}" title="home">
                {{ __('avored.home') }} >> 
            </a>
        </li>
       <li>
            <a class="text-gray-700" href="{{ route('account.dashboard') }}" title="home">
                {{ __('avored.user_dashboard') }} >> 
            </a>
        </li>
       <li> <span class="">{{ __('avored.show_order') }}</span></li>
    </ol>
</div>
@endsection


@section('content')
<user-order-show inline-template>
    <div class="block">
        <div class="flex">
            <div class="w-1/2">
                <div class="border rounded">
                    <div class="border-b font-semibold text-red-500 p-5 py-3">
                        {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.order')]) }}
                    </div>
                    <div class="p-5">
                        <p>{{ __('avored::system.fields.order_id')}}: <b>{{ $order->id }}</b></p>
                        <p>{{ __('avored::system.fields.payment_option')}}: <b>{{ $order->payment_option }}</b></p>
                        <p>{{ __('avored::system.fields.shipping_option')}}: <b>{{ $order->shipping_option }}</b></p>
                        <p>{{ __('avored::system.fields.created_at')}}: <b>{{ $order->created_at->format('d-M-Y') }}</b></p>    
                    </div>
                </div>
                <div class="border mt-5 rounded">
                    <div class="border-b font-semibold text-red-500 p-5 py-3">
                        {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.customer')]) }}
                    </div>
                    <div class="p-5">
                        <p>{{ __('avored::system.fields.customer_name')}}: <b>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</b></p>
                        <p>{{ __('avored::system.fields.customer_email')}}: <b>{{ $order->customer->email }}</b></p> 
                        <p>{{ __('avored::system.fields.customer_phone')}}: <b>{{ $order->customer->phone }}</b></p> 
                    
                    
                    </div>
                </div>

                <div class="border mt-5 rounded">
                    <div class="border-b font-semibold text-red-500 p-5 py-3">
                        {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.address')]) }}
                    </div>
                    <div class="p-5 flex w-full">
                        <div class="border rounded w-1/2">
                            <div class="border-b font-semibold text-red-500 p-5 py-3">
                                {{ __('avored::system.terms.shipping_address') }}
                            </div>
                            <div class="p-5">
                                {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }} <br/>
                                {{ $order->shippingAddress->phone }} <br/>
                                {{ $order->shippingAddress->address1 }} {{ $order->shippingAddress->address2 }} <br/>
                                {{ $order->shippingAddress->city }} <br/>
                                {{ $order->shippingAddress->state }} <br/>
                                {{ $order->shippingAddress->country->name }} <br/>
                                {{ $order->shippingAddress->postcode }} <br/>
                            </div>
                        </div>

                        <div class="border rounded w-1/2 ml-5">
                            <div class="border-b font-semibold text-red-500 p-5 py-3">
                                {{ __('avored::system.terms.billing_address') }}
                            </div>
                            <div class="p-5">
                                {{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }} <br/>
                                {{ $order->billingAddress->phone }} <br/>
                                {{ $order->billingAddress->address1 }} {{ $order->billingAddress->address2 }} <br/>
                                {{ $order->billingAddress->city }} <br/>
                                {{ $order->billingAddress->state }} <br/>
                                {{ $order->billingAddress->country->name }} <br/>
                                {{ $order->billingAddress->postcode }} <br/>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            
            <div class="w-1/2 ml-5">
                <div class="border rounded">
                    <div class="border-b font-semibold text-red-500 p-5 py-3">
                        {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.product')]) }}
                    </div>
                    <div class="p-5">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($order->products as $product)
                            <div class="flex py-3 items-center">
                                <div class="w-3/6">
                                    {{ $product->product->name }}
                                </div>
                                <div class="w-1/6">
                                    {{ number_format($product->qty, 2) }}
                                </div>
                                <div class="w-1/6">
                                    {{ $order->currency->symbol }} {{ number_format($product->product->price, 2) }}
                                </div>
                                <div class="w-1/6">
                                    {{ $order->currency->symbol }} {{ number_format($product->tax_amount, 2) }}
                                </div>
                                <div class="w-1/6">
                                    <div class="font-semibold">
                                        {{ $order->currency->symbol }} {{ number_format($product->price * $product->qty, 2) }}
                                    </div>
                                </div>
                            </div>
                            @php
                                $total += $product->price * $product->qty;
                            @endphp
                            
                        @endforeach  
                        <hr/>
                        <div class="flex py-3 items-center">
                            <div class="w-3/6"></div>
                            <div class="w-1/6"></div>
                            <div class="w-1/6"></div>
                            <div class="w-1/6">
                                {{ __('avored::system.fields.total') }}
                            </div>
                            <div class="w-1/6">
                                <div class="font-semibold">
                                    {{ $order->currency->symbol }} {{ number_format($total, 2) }}
                                </div>
                            </div>
                        </div>  
                    </div>
                </div> <!-- END OF ORDER PRODUCTS CARD -->

                <div class="border mt-5 rounded">
                    <div class="border-b font-semibold text-red-500 p-5 py-3">
                        {{ __('avored::system.order') . ' ' . __('avored::system.comments') }}
                    </div>
                    <div class="p-5">
                        @foreach ($order->orderComments()->where(['is_private' => 0])->get() as $orderComment)
                            <div class="mt-3">
                                <div tabindex="0" class="cursor-pointer border rounded-md p-3 bg-white flex text-gray-700 mb-2 hover:border-red-500 focus:outline-none focus:border-red-500">
                                    <span class="flex-none pt-1 pr-2">
                                        <img class="h-8 w-8 rounded-md" 
                                            src="{{ $orderComment->commentable->image_path_url }}" 
                                        />
                                    </span>
                                    <div class="flex-1">
                                        
                                        <div class="mb-1">
                                            {{ $orderComment->commentable->full_name }} <span class="font-semibold">{{ __('avored::system.commented') }}</span>
                                        </div>
                                        <p class="text-gray-600">
                                            {{ $orderComment->content }}
                                        </p>
                                        <div class="text-gray-500 mt-2 text-sm">
                                            {{ $orderComment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <form method="post" action="{{ route('account.order-comment.store', ['order' => $order->id]) }}">
                            @csrf
                            <div class="mt-3">
                                <label class="block text-sm leading-5 text-gray-500" 
                                    for="page-content" title="{{ __('avored::cms.page.content') }}">
                                    {{ __('avored::system.comment') }}
                                </label>
                                <div class="mt-1">
                                    <vue-simplemde name="content" ref="markdownEditor" />
                                </div>
                            </div>
                           
                            <div class="mt-3 py-3">
                                <button type="submit"
                                    class="px-6 py-3 font-semibold leading-7  text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                                >   
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                                    </svg>
                                    <span class="ml-3">{{ __('avored::system.btn.save') }}</span>
                                </button>
                            </div>
                        
                        </form>
                    </div>

                </div> <!-- ORDER COMMENT CARD CLOSE -->
            </div>
        </div>
    </div>
</user-order-show>
@endsection
