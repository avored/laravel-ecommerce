<a href="/" title="Cart">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            FRONT
        </span>
    </paper-icon-item>
</a>

@if(Auth::guard('customer')->check())
<a href="/my-account" title="Cart">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            My Account
        </span>
    </paper-icon-item>
</a>
@else

<a href="/customer/login" title="Cart">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Login
        </span>
    </paper-icon-item>
</a>

<a href="/customer/register" title="Cart">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Register
        </span>
    </paper-icon-item>
</a>

@endif

<a href="/Cart" title="Cart">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Cart
        <paper-badge label="3"></paper-badge>
        </span>
    </paper-icon-item>
</a>

<a href="/checkout" title="Checkout">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Checkout
        </span>
    </paper-icon-item>
</a>

<hr/>


<a href="/admin" title="Dashboard">
    <paper-icon-item>
        <iron-icon icon="home" item-icon></iron-icon>
        <span>
            Admin
        </span>
    </paper-icon-item>
</a>

<a href="/admin/product" title="Products List">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Product
        </span>
    </paper-icon-item>
</a>

<a href="/admin/order" title="Order List">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Order
        </span>
    </paper-icon-item>
</a>

<a href="/admin/page" title="Page List">
    <paper-icon-item>
        <iron-icon icon="inbox" item-icon></iron-icon>
        <span>
            Page
        </span>
    </paper-icon-item>
</a>




<a href="/admin/logout" title="Logout">
    <paper-icon-item>
        <iron-icon icon="visibility-off" item-icon></iron-icon>
        <span>
            Logout
        </span>
    </paper-icon-item>
</a>



<!--
<paper-icon-item>
    <iron-icon icon="query-builder" item-icon></iron-icon>
    <span>Categories</span>
</paper-icon-item>


<paper-icon-item>
    <iron-icon icon="done" item-icon></iron-icon> <span>Done</span>
</paper-icon-item>
<paper-icon-item>
    <iron-icon icon="drafts" item-icon></iron-icon> <span>Drafts</span>
</paper-icon-item>
<paper-icon-item>
    <iron-icon icon="send" item-icon></iron-icon> <span>Sent</span>
</paper-icon-item>
<paper-icon-item>
    <iron-icon icon="delete" item-icon></iron-icon> <span>Trash</span>
</paper-icon-item>
<paper-icon-item>
    <iron-icon icon="report" item-icon></iron-icon> <span>Spam</span>
</paper-icon-item>

-->