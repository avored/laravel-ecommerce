<footer class="page-footer mt-3 pb-3 border border-bottom-0 border-left-0 border-right-0 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="widget block block-static-block">
                    <ul class="footer links">
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
                <ul class="footer links">
                    <li class="nav item">
                        <a href="#">Privacy & Cookie Policy</a>
                    </li>
                    <li class="nav item">
                        <a href="#">Orders</a>
                    </li>
                    <li class="nav item">
                        <a href="#">Returns</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <!-- SUBSCRIBE FORM GOES HERE  -->
                @include('avored-subscribe::subscribe.form')
            </div>
        </div>
    </div>
</footer>

<footer class="row">
    <div class="container-fluid bg-dark">

        <div class="copyright text-center p-2 text-white">
            <span>Copyright &copy; {{ date('Y') }} <a href="http://avored.website" title="AvoRed Company"
                                                      target="_blank">AvoRed</a>. All rights reserved.</span>

        </div>
    </div>
</footer>