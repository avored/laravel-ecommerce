<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand">

            <a class="navbar-brand" href="{{ route('home') }}">Mage2</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="col-sm-3 col-md-3 col-sm-offset-2 col-md-offset-0 mr-0">
            <form class="navbar-form" action="{{ route('search.result') }}" method="get" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="q">

                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="oi oi-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
            <div class="collapse navbar-collapse justify-content-end" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ">

                @include('layouts.category-tree',['categories', $categories])

                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.view') }}">Cart ({{$cart}})</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('checkout.index') }}">Checkout</a></li>

                    <li class="dropdown nav-item">
                        <a href="{{ route('my-account.home') }}" title="My Account" class="nav-link">
                            My Account
                        </a>

                    </li>
            </ul>
        </div>

        </nav>
    </div>
</div>