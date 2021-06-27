<nav class="">
<ul class="block text-center">
   
    <li class="py-3 border-b block">
        <a class="py-3"  href="{{ route('account.dashboard') }}">
            {{ __('Profile') }}
        </a>
    </li>
    <li class="py-3 border-b block">
        <a class="py-3" href="{{ route('account.upload') }}">
            {{ __('Upload Photo') }}
        </a>
    </li>
    <li class="py-3 border-b block">
        <a class="py-3" href="{{ route('account.address.index') }}">
            {{ __('Addresses') }}
        </a>
    </li>
    <li class="py-3 border-b block">
        <a class="py-3" href="{{ route('account.order.index') }}">
            {{ __('Orders') }}
        </a>
    </li>
    <li class="py-3 border-b block">
        <a class="py-3" href="{{ route('account.wishlist.index') }}">
            {{ __('avored.my_wishlist') }}
        </a>
    </li>
    <li class="py-3 border-b block">
        <a class="py-3" href="{{ route('logout') }}">
            {{ __('Logout') }}
        </a>
    </li>
</ul>
</nav>
