<div class="profile-sidebar">

    <div class="profile-userpic">
        @if($user->image_path == "")
            <img src="http://placehold.it/500x500" class="img-responsive" alt="">
        @else
            <img src="{{ asset("/uploads/" .$user->image_path) }}" class="img-responsive" alt="">
        @endif
    </div>
    <div class="text-center">
        <div class="profile-usertitle-name">
            <strong>{{ $user->fullName }}</strong>
        </div>

    </div>

    <div class="profile-usermenu">
        <ul class="collection nav nav-stacked">
            <li>
                <a href="{{ route('my-account.home') }}" class="collection-item">

                    Overview </a>
            </li>
            <li>
                <a href="{{ route('my-account.edit') }}" class="collection-item">

                    Edit Account</a>
            </li>
            <li>
                <a href="{{ route('my-account.upload-image') }}" class="collection-item">

                    Upload Image</a>
            </li>
            <li>
                <a href="{{ route('my-account.order.list') }}" class="collection-item">

                    My Order</a>
            </li>
            <li>
                <a href="{{ route('my-account.address.index') }}" class="collection-item">

                    Address </a>
            </li>
            <li>
                <a href="{{ route('wishlist.list') }}" class="collection-item">

                    My Wishlist</a>
            </li>
            <li>
                <a href="{{ route('my-account.change-password') }}" class="collection-item">

                    Change Password</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="collection-item">

                    Logout </a>

            </li>

        </ul>
    </div>

</div>