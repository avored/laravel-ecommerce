<a-menu
    mode="inline"
    theme="light"
    :default-selected-keys="['{{  Route::currentRouteName() }}']"
    style="height: 100%"
>
    <a-menu-item key="account.dashboard">
        <a href="{{ route('account.dashboard') }}">
            {{ __('Profile') }}
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
