<div class="profile-sidebar">

    <div class="profile-userpic">
        <img src="http://placehold.it/500x500" class="responsive-img" alt="">
    </div>
    <div class="text-center">
        <div class="profile-usertitle-name">
            <strong>{{ $user->fullName }}</strong>
        </div>

    </div>

    <div class="profile-usermenu">
        <ul class="collection">

                <a href="{{ route('my-account.home') }}" class="collection-item">

                    Overview </a>
                <a href="{{ route('my-account.edit') }}" class="collection-item">

                    Edit Account</a>
                <a href="{{ route('my-account.order.list') }}" class="collection-item">

                        My Order</a>
                <a href="{{ route('my-account.address.index') }}" class="collection-item">

                    Address </a>
                <a href="{{ route('wishlist.list') }}" class="collection-item">

                    My Wishlist</a>
                <a href="{{ route('logout') }}" class="collection-item">

                    Logout </a>

        </ul>
    </div>

</div>