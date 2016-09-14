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
                    <i class="glyphicon glyphicon-dashboard"></i>
                    Overview </a>
                <a href="{{ route('my-account.edit') }}" class="collection-item">
                    <i class="glyphicon glyphicon-user"></i>
                    Edit Account</a>
                <a href="{{ route('my-account.address.index') }}" class="collection-item">
                    <i class="glyphicon glyphicon-home"></i>
                    Address </a>
                <a href="{{ route('wishlist.list') }}" class="collection-item">
                    <i class="glyphicon glyphicon-user"></i>
                    My Wishlist</a>
                <a href="{{ route('front.logout') }}" class="collection-item">
                    <i class="glyphicon glyphicon-log-out"></i>
                    Logout </a>

        </ul>
    </div>

</div>