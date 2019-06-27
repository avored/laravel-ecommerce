@extends('layouts.user')

@section('content')
<a-row type="flex" class="mb-1" justify="end">
    <a-col>
        <a 
            href="{{ route('account.address.create') }}"
            class="ant-btn ant-btn-primary">
            <a-icon type="plus"></a-icon>
            {{ __('Create') }}
        </a>
    </a-col>
</a-row>
<a-row type="flex" :gutter="15" style="margin-top: 1rem">
    <a-col :span="12">
        @foreach ($userAddresses as $address)
            <a-card title="{{ $address->type }}">
                <a-dropdown slot="extra">
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
                </a-dropdown>
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
            </a-card>
        @endforeach
    </a-col>
</a-row>

@endsection
