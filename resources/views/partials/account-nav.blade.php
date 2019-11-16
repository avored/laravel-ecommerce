<a-menu
    mode="inline"
    theme="light"
    :default-selected-keys="['{{  Route::currentRouteName() }}']"
    style="height: 100%"
>
    <a-menu-item style="min-height:120px;text-align:center">
        @if(empty(Auth::user()->image))
            <a-avatar 
                shape="square"
                style="backgroundColor:#E64448;width:100%;height:100px">
                {{ Auth::user()->name }}</a-avatar>
        @else
            <a-avatar 
                shape="square"
                style="width:100%; height: auto"
                src="{{ '/storage/' . Auth::user()->image }}">
            </a-avatar>
        @endif
    </a-menu-item>
    <a-menu-item key="account.dashboard">
        <a href="{{ route('account.dashboard') }}">
            {{ __('Profile') }}
        </a>
    </a-menu-item>
    <a-menu-item key="account.upload">
        <a href="{{ route('account.upload') }}">
            {{ __('Upload Photo') }}
        </a>
    </a-menu-item>
    <a-menu-item key="account.address.index">
        <a href="{{ route('account.address.index') }}">
            {{ __('Addresses') }}
        </a>
    </a-menu-item>
    <a-menu-item key="account.order.index">
        <a href="{{ route('account.order.index') }}">
            {{ __('Orders') }}
        </a>
    </a-menu-item>
</a-menu>
