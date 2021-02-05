@extends('layouts.user')

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
      <a href="{{ route('account.dashboard') }}" class="text-gray-700" title="home">
        {{ __('avored.account_dashboard') }}
      </a>
      <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
    </li>
    <li class="flex items-center">
      <a href="#" class="text-gray-700" title="home">
        {{ __('avored.addresses') }}
      </a>
    </li>
   
  </ol>
</nav>
@endsection

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <div class="w-full flex">
            <h2 class="text-2xl text-red-700">{{ __('avored.addresses') }}</h2>
            <a href="{{ route('account.address.create') }}"
                class="px-3 py-1 ml-auto inline-block text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
                <span class="leading-7">
                    {{ __('avored.create') }}
                </span>
            </a>
        </div>
    </div>
    <div class="border-t px-4 py-5 border-gray-200">
        <div class="flex flex-wrap overflow-hidden lg:-mx-4 xl:-mx-4">

            @foreach ($userAddresses as $address)
                <div class="w-full overflow-hidden lg:my-4 lg:px-4 lg:w-1/2 xl:my-4 xl:px-4 xl:w-1/2">
                    <div class="border">
                        <div class="p-5 flex border-b">
                            <span class="">
                                {{ $address->type }}
                            </span>
                            <span class="ml-auto">
                                <div class="ml-auto flex items-center mr-3">
                                    <avored-dropdown>
                                        <button type="button" class="inline-flex items-center justify-between px-2 py-1 font-medium text-gray-700 transition-all duration-500 rounded-md focus:outline-none focus:text-brand-900 sm:focus:shadow-outline">
                                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4zm0-6a2 2 0 100-4 2 2 0 000 4zm0 12a2 2 0 100-4 2 2 0 000 4z" fill="#000" fill-rule="evenodd"/></svg>
                                        </button>
                                        <template slot="dropdown-content">
                                            <div class="relative mt-2 py-3 w-20 bg-white border border-gray-200">
                                                <a href="{{ route('account.address.edit', $address->id) }}"
                                                    class="w-full px-3 mb-2">
                                                    Edit
                                                </a>
                                                <a href="#"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('address-destroy-form-{{ $address->id }}').submit();"
                                                    class="w-full px-3 mb-2">
                                                    Destroy
                                                </a>
                                                
                                                <form id="address-destroy-form-{{ $address->id }}" 
                                                    action="{{ route('account.address.destroy', $address->id) }}" 
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </template>
                                    </avored-dropdown>
                                </div>
                            </span>

                        </div>
                        <div class="p-5">
                                <form style="display:none"
                                    id="address-destory-{{ $address->id }}"
                                    method="post"
                                    action="{{ route('account.address.destroy', $address->id) }}"
                                >
                                    @csrf
                                    @method('delete')
                                </form>
                                @if(empty($address))
                                <p>{{ $address->first_name }} {{ $address->last_name }}</p>
                                <p>{{ $address->company_name }}</p>
                                <p>{{ $address->phone }}</p>
                                <p>{{ $address->address1 }}, {{ $address->address2 }}</p>
                                <p>{{ $address->city }}, {{ $address->postcode }}</p>
                                <p>{{ $address->state }}: {{ $address->country->name }}</p>
                                @else
                                The Shipping Address is empty
                                @endif
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
