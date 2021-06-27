@extends('layouts.app')

@section('breadcrumb')
<nav class="text-black bg-gray-400 rounded mb-5 py-2 px-5" aria-label="Breadcrumb">
  <ol class="list-none p-0 inline-flex">
    <li class="flex items-center">
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('avored.home') }}
      </a>
      <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
    </li>
   
    <li class="flex items-center">
      <a href="#" class="text-gray-700" title="home">
        {{ __('avored.cart_page') }}
      </a>
    </li>
   
  </ol>
</nav>
@endsection

@section('content')
<cart-page 
    :items="{{ Cart::toArray() }}"
    cart-update-url="{{ route('cart.update') }}"
    checkout-url="{{ route('checkout.show') }}"
    discount-total="{{ Cart::discount() }}"
    cart-total="{{ Cart::total() }}"
    coupon-url="/apply-promotion-code"
    :default-currency="{{ json_encode(session()->get('default_currency')) }}"
    cart-delete-url="{{ route('cart.destroy') }}" 
    inline-template>

<div class="my-6">
    <h1 class="mb-6 text-red-800 font-semibold text-2xl">
        {{ __('avored.cart_page') }}
    </h1>
    <div class="w-full p-8 text-gray-800 bg-white shadow-lg">
        
    <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
            <tr class="h-12 uppercase">
                <th class="md:table-cell"></th>
                <th class="hidden md:table-cell"></th>
                <th class="text-left">
                    {{ __('avored.product') }}
                </th>
                <th class="lg:text-right text-left pl-5 lg:pl-0">
                    <span class="lg:hidden" title="{{ __('avored.qty') }}">
                        {{ __('avored.qty') }}
                    </span>
                    <span class="hidden lg:inline">{{ __('avored.qty') }}</span>
                </th>
                <th class="hidden text-right md:table-cell">
                    {{ __('avored.unit_price') }}
                </th>
                <th class="text-right">{{ __('avored.total_price') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cartItems" :key="item.slug">
                <td class="table-cell p-2">
                    <input type="checkbox" @change="checkboxChange($event, item)" />
                </td>
                <td class="hidden pb-4 md:table-cell">
                    <a href="#">
                        <img
                            :src="item.image"
                            class="w-20 rounded"
                            :alt="item.name"
                        />
                    </a>
                </td>
                <td>
                    <a href="#">
                        <p class="mb-2 md:ml-4">@{{ item.name }}</p>
                    </a>
                </td>
                <td class="justify-center md:justify-end md:flex mt-6">
                    <div class="w-20 h-10">
                        <div class="relative flex flex-row w-full h-8">
                            <input
                                type="number"
                                v-model="item.qty"
                                class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
                            />
                        </div>
                    </div>
                </td>
                <td class="hidden text-right md:table-cell">
                    <span class="text-sm lg:text-base font-medium">
                        @{{ defaultCurrency.symbol }}@{{ parseFloat(item.price).toFixed(2) }}
                    </span>
                </td>
                <td class="text-right">
                    <span class="text-sm lg:text-base font-medium">
                        @{{ defaultCurrency.symbol }}@{{ parseFloat(item.price * item.qty).toFixed(2) }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    <hr class="pb-6 mt-6" />

    <div class="my-4 mt-6 -mx-2 lg:flex" v-if="showCartActionBtn">
        <button type="button" @click="clickOnCartUpdate">
            <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path
                class="heroicon-ui"
                d="M6.3 12.3l10-10a1 1 0 011.4 0l4 4a1 1 0 010 1.4l-10 10a1 1 0 01-.7.3H7a1 1 0 01-1-1v-4a1 1 0 01.3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 012 0v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6c0-1.1.9-2 2-2h6a1 1 0 010 2H4v14h14v-6z"
            />
            </svg>
        </button>

        <button type="button" @click="delteCartProductClick">
            <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
            </svg>
        </button>
    </div>

    <!-- ***  START OF SUMMARY *** -->
    <div class="my-4 mt-6 -mx-2 lg:flex">
        
        <div class="lg:px-2 lg:w-full">
            <div class="flex justify-between pt-4 border-b">
                <div
                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                >
                    {{ __('avored.subtotal') }}
                </div>
                <div
                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                >
                    @{{ defaultCurrency.symbol }}@{{ subtotal.toFixed(2)  }}
                </div>
            </div>
            <div class="flex justify-between pt-4 border-b">
                <div
                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                >
                    Tax
                </div>
                <div
                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                >
                    @{{ defaultCurrency.symbol }}@{{ totalTax.toFixed(2) }}
                </div>
            </div>
            <div class="flex justify-between pt-4 border-b">
                <div
                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                >
                    {{ __('avored.discount_coupon') }}
                </div>
                <div
                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                >
                    <div class="flex items-center">
                        <avored-input
                            v-model="promotionCode"
                        ></avored-input>
                        <button
                            @click="applyPromotionCodeClicked"
                            type="button" 
                            class="ml-3 bg-red-500 text-white text-xs px-2 py-3 leading-6 rounded">
                            {{ __('avored.apply') }}
                        </button>
                    </div>
                </div>
            </div>
            @if (Cart::discount() > 0)
                <div class="flex justify-between pt-4 border-b">
                    <div
                        class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                    >
                        {{ __('avored.discount') }}
                    </div>
                    <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">   
                        <span v-if="parseFloat(discountTotal)>0">-</span> 
                        @{{ defaultCurrency.symbol }}@{{ discountTotal }}
                    </div>
                </div>
            @endif
            <div class="flex justify-between pt-4 border-b">
                <div
                    class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800"
                >
                    {{ __('avored.total') }}
                </div>
                <div
                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"
                >
                    @{{ defaultCurrency.symbol }}@{{ cartTotal }}
                </div>
            </div>
                <a :href="checkoutUrl">
                    <button
                        class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none"
                    >
                        <svg
                            aria-hidden="true"
                            data-prefix="far"
                            data-icon="credit-card"
                            class="w-8"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512"
                        >
                            <path
                                fill="currentColor"
                                d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"
                            />
                        </svg>
                        <span class="ml-2 mt-5px">
                            {{ __('avored.checkout') }}
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- ***  END OF SUMMARY *** -->

</div>
</cart-page>
@endsection
