<div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-heading">User</div>
        <div class="panel-body">
            <ul class="nav  nav-stacked">
                <li><a href="{!! url('/customer/account') !!}" title="User Account">User Dashboard</a></li>
                <li><a href="{!! url('/customer/account/billing') !!}" title="User Billing Address">Billing Address</a>
                </li>
                <li><a href="{!! url('/customer/account/shipping') !!}" title="User Shipping Address">Shipping
                        Account</a></li>
                <li><a href="{!! url('/customer/account/order') !!}" title="Orders">Orders</a></li>
                <!--<li><a href="" title="Reviews">Reviews</a></li>-->
                <li><a href="{!! url('/logout') !!}" title="Logout">Logout</a></li>
            </ul>
        </div>
    </div>
</div>