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
        {{ __('Address') }}
    </div>
</div>
@endsection


@section('content')
<div class="flex" class="mb-1">
    <div class="w-full mt-4 flex">
        <h2 class="text-2xl text-red-700">{{ __('User Addressses') }}</h2>
        <a href="{{ route('account.address.create') }}"
            class="px-3 py-1 ml-auto inline-block text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
            <span class="leading-7">
                {{ __('avored.btn.create') }}
            </span>
        </a>
    </div>
</div>
<div class="flex mt-5">
    @foreach ($userAddresses as $address)
        <div class="w-1/2 mr-3">
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
                    {{-- <a-dropdown slot="extra">
                        <a class="ant-dropdown-link"  href="">
                            {{ __('Options') }} <a-icon type="down" />
                        </a>
                        <a-menu slot="overlay">
                            <a-menu-item>
                                <a href="{{ route('account.address.edit', $address->id) }}">{{ __('Edit') }}</a>
                            </a-menu-item>
                            <a-menu-item>
                                <a onClick="event.preventDefault();document.getElementById('address-destory-{{ $address->id }}').submit()"
                                    href="#">{{ __('Delete') }}</a>
                            </a-menu-item>
                        </a-menu>
                    </a-dropdown> --}}
                        <form style="display:none"
                            id="address-destory-{{ $address->id }}"
                            method="post"
                            action="{{ route('account.address.destroy', $address->id) }}"
                        >
                            @csrf
                            @method('delete')
                        </form>
                        <p>{{ $address->first_name }} {{ $address->last_name }}</p>
                        <p>{{ $address->company_name }}</p>
                        <p>{{ $address->phone }}</p>
                        <p>{{ $address->address1 }}, {{ $address->address2 }}</p>
                        <p>{{ $address->city }}, {{ $address->postcode }}</p>
                        <p>{{ $address->state }}: {{ $address->country->name }}</p>
                    </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
