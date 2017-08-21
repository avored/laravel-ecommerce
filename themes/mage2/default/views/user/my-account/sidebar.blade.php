<div class="profile-sidebar">

    <div class="profile-userpic">

        @if($user->image_path == "")
            <img src="http://placehold.it/250x250" class="img-responsive img-thumbnail" alt="">
        @else
            <img src="{{ $user->image_path->smallUrl }}" class="img-responsive img-thumbnail" alt="">
        @endif
    </div>
    <div class="text-center">
        <div class="profile-usertitle-name">
            <strong>{{ $user->fullName }}</strong>
        </div>

    </div>

    <div class="profile-usermenu">
        <ul class="collection nav nav-stacked nav-pills">
            <li class="nav-item">
                <a href="{{ route('my-account.home') }}" class="nav-link nav-link">

                    Overview </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my-account.edit') }}" class="nav-link">

                    Edit Account</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my-account.upload-image') }}" class="nav-link">

                    Upload Image</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my-account.order.list') }}" class="nav-link">

                    My Order</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my-account.address.index') }}" class="nav-link">

                    Address </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('wishlist.list') }}" class="nav-link">

                    My Wishlist</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('my-account.change-password') }}" class="nav-link">

                    Change Password</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">

                    Logout </a>

            </li>

        </ul>
    </div>

</div>