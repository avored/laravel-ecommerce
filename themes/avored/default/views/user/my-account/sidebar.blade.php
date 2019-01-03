<div class="profile-sidebar">
    <div class="myaccount-sidebar nav">
         @foreach($menus as $menu)
         <a href="{{ route($menu->route) }}" {{ Route::is($menu->route) ? ' class=active-link' : null }}>{{ $menu->name }}</a>
          @endforeach        
    </div>
</div>
