@extends('layouts.user')

@section('breadcrumb')
<div class="flex">
    <div>
      <a href="{{ route('home') }}" class="text-gray-700" title="home">
        {{ __('Home') }} >>
      </a>
    </div>
    <div class="ml-1">
      <a href="{{ route('account.dashboard') }}" class="text-gray-700" title="user dashboard">
        {{ __('User Dashboard') }} >>
      </a>
    </div>
    
    <div class="ml-1 text-gray-700">
        {{ __('Orders') }}
    </div>
</div>
@endsection

@section('content')
<div class="flex">
    <div class="flex">
        <h1 class="text-2xl font-semibold text-red-700 my-5">{{  __('Orders') }}</h1>
    </div>
</div>
<div class="flex">
    <div class="w-full">
        <user-order-table base-url="{{ route('account.order.index') }}" :init-orders="{{ json_encode($userOrders) }}">
        
        </user-order-table>
    </div>
</div>

@endsection
