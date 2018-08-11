<div class="title">
    <strong>Newsletter</strong>
</div>
<div class="content">
    <div class="field newsletter">
        <label class="label" for="newsletter">
            <span>Sign Up for Our Newsletter:</span>
        </label>
    </div>
    <form class="navbar-form" action="{{ route('subscribe.store') }}" method="post">
        @csrf

        <div class="input-group">

            <input type="text"
                   class="form-control {{ $errors->has('subscribe_email') ? ' is-invalid' : '' }}"
                   placeholder="Enter your email address"
                   name="subscribe_email"
            />

            <div class="input-group-btn">

                <button class="btn btn-primary" type="submit">
                    <span>Subscribe</span>
                </button>
            </div>


            @if($errors->has('subscribe_email'))
                <div class="invalid-feedback">
                    {{ $errors->first('subscribe_email') }}
                </div>
            @endif
        </div>
    </form>
</div>