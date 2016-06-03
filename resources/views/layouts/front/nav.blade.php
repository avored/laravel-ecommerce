<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="/" class="brand-logo">Mage2</a>
        <ul class="right hide-on-med-and-down">

            @if(!Auth::guard('customer')->check()):
            <li><a href="/customer/login">Login</a></li>
            <li><a href="/customer/register">Register</a></li>
            @else
                <li><a href="/customer/logout">Logout</a></li>
            @endif
            <li><a href="/checkout/step1">Checkout</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/admin">Admin</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="/customer/login">Login</a></li>
            <li><a href="/customer/register">Register</a></li>
            <li><a href="/checkout">Checkout</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="/admin">Admin</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
























<!--
<paper-icon-item>
    <iron-icon icon="inbox" item-icon></iron-icon>
    <span>
        <a href="/admin/product" title="Products List">
            Products
        </a>


    </span>
</paper-icon-item>
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