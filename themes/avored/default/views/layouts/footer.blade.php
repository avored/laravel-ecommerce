<footer class="footer-main mt-3 pb-3 border border-bottom-0 border-left-0 border-right-0 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Information</h5>
                <div class="footer-menu">
                    <ul>
                        <li class="nav item">
                            <a href="#">About us</a>
                        </li>
                        <li class="nav item">
                            <a href="#">Contact us</a>
                        </li>
                        <li class="nav item">
                            <a href="#">Customer Service</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <h5>Customer service</h5>
                <ul>
                    <li class="nav item">
                        <a href="#">Privacy & Cookie Policy</a>
                    </li>
                    <li class="nav item">
                        <a href="{{ route('my-account.order.list') }}">Orders</a>
                    </li>
                    <li class="nav item">
                        <a href="#">Returns</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4"> 
                @include('avored-subscribe::subscribe.form')
            </div>
        </div>
    </div>
</footer>

<footer class="bg-dark">
    <div class="container-fluid">
        <div class="footer-copyright text-center text-white">
            <span>Copyright &copy; {{ date('Y') }} 
                <a href="https://www.avored.com" title="AvoRed an Laravel E commerce" target="_blank">AvoRed</a> All rights reserved.
            </span>
        </div>
    </div>
</footer>
