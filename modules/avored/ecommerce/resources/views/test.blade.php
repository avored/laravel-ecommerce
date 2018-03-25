<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AvoRed Ecommerce') }}</title>

    <link href="{{ asset('vendor/avored-admin/css/app.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    @stack('styles')
</head>
<body>


<aside class="sidebar">



    <ul class="side-nav navbar navbar-dark">


        <li class="nav-item  has-dropdown">
            <a class="has-submenu nav-link" href="#"><i class="fa fa-book"></i> Catalog

                <span class="caret"></span>
            </a>

            <ul class="sub-nav d-none">

                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/product"><i
                                class="fab fa-dropbox"></i> Product</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/category"><i
                                class="far fa-building"></i> Category</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/attribute"><i
                                class="fas fa-file-alt"></i> Attribute</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/property"><i
                                class="fas fa-file-powerpoint"></i> Property</a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-dropdown">
            <a class="has-submenu nav-link" href="#"><i class="fas fa-bullhorn"></i> Promotion

                <span class="caret"></span>
            </a>

            <ul class="sub-nav d-none">

                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/subscriber"><i
                                class="fas fa-users"></i> Subscriber</a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-dropdown">
            <a class="has-submenu nav-link" href="#"><i class="fas fa-chart-line"></i> Sales

                <span class="caret"></span>
            </a>

            <ul class="sub-nav d-none">

                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/order"><i
                                class="fas fa-dollar-sign"></i> Order</a>
                </li>

            </ul>
        </li>


        <li class="nav-item has-dropdown">
            <a class="has-submenu nav-link" href="#"><i class="fas fa-cogs"></i> System

                <span class="caret"></span>
            </a>

            <ul class="sub-nav d-none">

                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/configuration"><i
                                class="fas fa-cog"></i> Configuration</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/admin-user"><i
                                class="fas fa-user"></i> Admin User</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/themes"><i
                                class="fas fa-adjust"></i> Themes </a>
                </li>
                <li class="nav-item">

                    <a class="nav-link pl-5 list-group-item-action" href="http://localhost:8000/admin/role"><i
                                class="fab fa-periscope"></i> Role</a>
                </li>

            </ul>
        </li>

    </ul>
</aside>


<div class="main-content">

    <header>
        <nav class="navbar navbar-expand-lg navbar-inverse  bg-light">

            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">AvoRed</a>

            <ul class="nav navbar-nav mr-5 ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#"
                       id="navbarDropdown"
                       data-toggle="dropdown">
                        {{ Auth::guard('admin')->user()->first_name . " " .  Auth::guard('admin')->user()->last_name }}
                    </a>
                    <div class="dropdown-menu">

                        <a class="dropdown-item"
                           href="{{ route('admin.admin-user.show', Auth::guard('admin')->user()->id) }}">
                            My Account
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item"
                           href="{{ route('admin.logout') }}">

                            Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>

            </ul>
        </nav>

    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session()->has('notificationText'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>

                        <strong>Success!</strong> {{ session()->get('notificationText') }}

                    </div>
                @endif
            </div>
        </div>
        {!! Breadcrumb::render(Route::getCurrentRoute()->getName()  ) !!}

        <div class="row">


            <div class="col-md-12" style="min-height: 2000px;">
                <div class="h1">Dashboard</div>
            </div>
        </div>
    </div>

    @include('avored-ecommerce::admin.layouts.footer')
</div>


<script src="{{ asset('vendor/avored-admin/js/app.js') }}"></script>
@stack('scripts')

    <script>
        $(function() {
            $(document).on('click','.has-submenu',function(e) {
                e.preventDefault();
                jQuery(this).parents("li:first").find('.sub-nav:first').toggleClass('d-none');

            });
        });
    </script>

</body>
</html>
