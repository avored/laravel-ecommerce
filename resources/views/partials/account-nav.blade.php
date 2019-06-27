<a-menu
    mode="inline"
    theme="dark"
    :default-selected-keys="['profile']"
    style="height: 100%"
>
    <a-menu-item key="profile">
        <a href="{{ route('account.dashboard') }}">
            {{ __('Profile') }}
        </a>
    </a-menu-item>
    <a-menu-item key="address">
        <a href="{{ route('account.address.index') }}">
            {{ __('Addresses') }}
        </a>
    </a-menu-item>
</a-menu>
