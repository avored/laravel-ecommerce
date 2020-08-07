<nav class="flex">
<ul class="block text-center">
    <li class="p-5 borer-b">
        @if(empty(Auth::user()->image))
            <img class="rounded-full" src="https://placehold.it/250x250" {{ Auth::user()->name }} />
        @else
            <img src="{{ '/storage/' . Auth::user()->image }}" />
        @endif
    </li>
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
        <a class="py-3" href="{{ route('logout') }}">
            {{ __('Logout') }}
        </a>
    </li>
</ul>
</nav>
