 <a-layout-header>
    <a-row :gutter="15" type="flex">
        <a-col  :span="6">
            <a href="{{ route('home') }}">
                <div class="logo">AvoRed</div>
            </a>
        </a-col>
        <a-col :span="18">
            <a-menu
                theme="dark"
                mode="horizontal"
                :default-selected-keys="[]"
                class="navigation"
            >
                @foreach ($categories as $category)
                    <a-menu-item key="{{ $category->slug }}">
                        <a href="{{ route('category.show', ['category' => $category->slug]) }}">
                            {{ $category->name }}
                        </a>
                    </a-menu-item>
                @endforeach
                <a-menu-item key="cart">
                    <a href="{{ route('cart.show') }}">
                        {{ __('Cart')}}
                    </a>
                </a-menu-item>
                <a-menu-item key="checkout">
                    <a href="{{ route('checkout.show') }}">
                        {{ __('Checkout')}}
                    </a>
                </a-menu-item>
                
                @if (Auth::check())
                    <a-sub-menu title="{{ Auth::user()->name }}">
                        <a-menu-item>
                            <a href="{{ route('logout') }}">
                                Logout
                            </a>
                        </a-menu-item>
                    </a-sub-menu>
                @else
                    <a-menu-item key="login">
                        <a href="{{ route('login') }}">
                            Login
                        </a>
                    </a-menu-item>
                    <a-menu-item key="register">
                        <a href="{{ route('register') }}">
                            Register
                        </a>
                    </a-menu-item>
                @endif
            </a-menu>
        </a-col>
    </a-row>
</a-layout-header>
