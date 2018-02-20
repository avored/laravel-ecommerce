<footer class="page-footer">
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
                <div class="title">
                    <strong>Newsletter</strong>
                </div>
                <div class="content">
                    <form class="navbar-form" action="{{ route('subscribe.store') }}" method="post" >

                        @csrf
                        <div class="field newsletter">
                            <label class="label" for="newsletter">
                                <span>Sign Up for Our Newsletter:</span>
                            </label>
                        </div>



                        <div class="input-group">

                            <input type="text"

                                   @if($errors->has('subscriber_email'))
                                        class="form-control is-invalid"
                                   @else
                                        class="form-control"
                                   @endif

                                   placeholder="Enter your email address" name="subscriber_email" />


                            <div class="input-group-btn">

                                <button class="btn btn-primary" type="submit">
                                    <span>Subscribe</span>
                                </button>
                            </div>


                            @if($errors->has('subscriber_email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('subscriber_email') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>

<footer>
    <small class="copyright bg-dark">    
        <span>Copyright &copy; {{ date('Y') }} <a href="http://mage2.website" title="Mage2 Company" target="_blank">Mage2</a>. All rights reserved.</span>
    </small>
</footer>