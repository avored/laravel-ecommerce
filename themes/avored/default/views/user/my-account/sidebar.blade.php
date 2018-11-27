<div class="profile-sidebar">



    <div class="profile-usermenu">
        <ul class="collection list-group">
            <li class="list-group-item">
            @if($user->image_path == "")
                <img src="http://placehold.it/250x250" class="img-responsive img-thumbnail" alt="">
                    <strong class="text-center">{{ $user->fullName }}</strong>
            @else
                <img src="{{ $user->image_path->smallUrl }}" class="img-responsive img-thumbnail" alt="">
                    <strong class="text-center">{{ $user->fullName }}</strong>
            @endif
            </li>

            @foreach($menus as $menu)
            <a href="{{ route($menu->route) }}" class="list-group-item list-group-item-action">
                {{ $menu->name }} 
            </a>
            @endforeach
        </ul>
    </div>

</div>
