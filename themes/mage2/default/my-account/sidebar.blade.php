<div class="profile-sidebar">

    <div class="profile-userpic">
        <img src="http://placehold.it/500x500" class="img-thumbnail img-responsive img-circle" alt="">
    </div>
    <div class="text-center">
        <div class="profile-usertitle-name">
            <strong>{{ $user->fullName }}</strong>
        </div>

    </div>

    <div class="profile-usermenu">
        <ul class="nav">
            <li class="active">
                <a href="{{ route('my-account.home') }}">
                    <i class="glyphicon glyphicon-dashboard"></i>
                    Overview </a>
            </li>
            <li>
                <a href="{{ route('my-account.edit') }}">
                    <i class="glyphicon glyphicon-user"></i>
                    Edit Account</a>
            </li>
            <li>
                <a href="{{ route('my-account.address.index') }}" >
                    <i class="glyphicon glyphicon-home"></i>
                    Address </a>
            </li>
            <li>
                <a href="{{ route('wishlist.list') }}">
                    <i class="glyphicon glyphicon-user"></i>
                    My Wishlist</a>
            </li>
            <li>
                <a href="{{ route('front.logout') }}">
                    <i class="glyphicon glyphicon-log-out"></i>
                    Logout </a>
            </li>
        </ul>
    </div>

</div>