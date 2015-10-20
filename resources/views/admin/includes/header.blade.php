<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ @url('/admin') }}">Mage2 Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <!--
                <li><a href="{!! @url('admin/entity') !!}" title="Entity">Entity</a></li>
                <li><a href="{!! @url('admin/attribute') !!}" title="Attribute">Attribute</a></li>
                -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Store <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{!! @url('admin/product') !!}" title="Product">Product</a></li>
                        <li><a href="{!! @url('admin/category') !!}" title="Category">Category</a></li>
                        <li><a href="{!! @url('admin/pages') !!}" title="Pages">Pages</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{!! url('/admin/settings') !!}">Settings</a></li>
                    </ul>
                </li>
                <!--<li><a href="{!! @url('admin/customer-group') !!}" title="Customer Group">Customer Group</a></li>-->
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="{!! url('/') !!}" target="_blank" title="View site">View Site</a></li>
                <?php if (!Auth()->check()): ?>
                    <li><a href="{!! url('/admin/login') !!}">Login</a></li>


                <?php else: ?>
                    <li role="presentation" class="dropdown">
                        <a href="{!! url('/customer/account') !!}" title="My Account"  class="dropdown-toggle" data-toggle="dropdown" >
                            My Account <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li ><a href="{!! url('/admin/user/edit-account') !!}" title="Edit Account">Edit Account</a></li>

                            <li><a href="{!! url('/admin/logout') !!}">Logout</a></li>
                        </ul>
                    </li>

                <?php endif; ?>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>