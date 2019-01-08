<nav class="navbar navbar-expand-md navbar-dark bg-red" style="padding:0;">
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link">&nbsp;</a>
            </li>
        </ul>
        
        <ul class="navbar-nav">
            @auth()
                <li class="nav-item ">
                    <a class="nav-link" href="#">Welcome {{ Auth::user()->full_name }} !
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('my-account.home') }}">My Account
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @endauth

            @guest()
                @if($currencies->count() > 1)
                <li class="nav-item dropdown" >
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Currency : {{ Session::get('currency_symbol')}}</a>
                    <div class="dropdown-menu">
                        @foreach($currencies as $siteCurrencyId => $currencyCode)
                            <?php
                            if (strpos(URL::current(), '?')) {
                                $url = URL::current() . '&currency_code=' . $currencyCode;
                            } else {
                                $url = URL::current() . '?currency_code=' . $currencyCode;
                            }
                            ?>
                            <a class="dropdown-item" href="{{ $url }}">{{ $currencyCode}}</a>
                        @endforeach
                    </div>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.signin') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.create') }}</a>
                </li>
            @endguest()
        </ul>
    </div>
</nav>
