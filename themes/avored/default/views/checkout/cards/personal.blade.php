<div class="card">
    <div class="card-header">
        Your Personal Details
    </div>
    <div class="card-body">
        @php
        $firstName = $lastName = $phone = "";
        if (Auth::check()) {
            $firstName = Auth::user()->first_name;
            $lastName = Auth::user()->last_name;
            $phone = Auth::user()->phone;
        }
        @endphp

        <div class="row">
            <div class="form-group  col-6">
                <label class="control-label" for="input-user-first-name">First Name</label>
                <input type="text" name="billing[first_name]"
                       value="{{ $firstName }}" placeholder="First Name"
                       id="input-user-first-name"
                       @if($errors->has('billing.first_name'))
                       class="is-invalid avored-checkout-field form-control"
                       @else
                       class="form-control avored-checkout-field"
                        @endif
                />
                @if ($errors->has('billing.first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('billing.first_name') }}
                    </div>
                @endif

            </div>

            <div class="form-group  col-6">
                <label class="control-label" for="input-user-last-name">Last Name</label>
                <input type="text" name="billing[last_name]"
                       value="{{ $lastName }}" placeholder="Last Name"
                       id="input-user-last-name"
                        @if($errors->has('billing.last_name'))
                            class="is-invalid form-control avored-checkout-field"
                        @else
                            class="form-control avored-checkout-field"
                        @endif
                />
                @if ($errors->has('billing.last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('billing.last_name') }}
                    </div>
                @endif
            </div>
        </div>

        @if(!Auth::check())

            <div class="form-group">
                <label class="control-label" for="input-user-email">E-Mail</label>
                <input
                        type="text"
                        name="user[email]" placeholder="E-Mail"
                        id="input-user-email"

                        @if($errors->has('user.email'))
                        class="is-invalid avored-checkout-field form-control"
                        @else
                        class="form-control avored-checkout-field"
                        @endif
                >
                @if ($errors->has('user.email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user.email') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="register"
                           onclick="if (this.checked == true) jQuery('.register-form').css('display','block');
                                                      else jQuery('.register-form').css('display','none');">
                    &nbsp;Register Account
                </label>
            </div>


            <div class="register-form" style="display: none;">
                <div class="row">
                    <div class="form-group  col-6">
                        <label class="control-label"
                               for="input-billing-password">Password</label>
                        <input type="password" name="user[password]" placeholder="Password"
                               id="input-billing-password"

                               @if($errors->has('user.password'))
                               class="is-invalid avored-checkout-field form-control"
                               @else
                               class="form-control avored-checkout-field"
                                @endif
                        />
                        @if ($errors->has('user.password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user.password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group  col-6">
                        <label class="control-label" for="input-billing-confirm">Password
                            Confirm</label>
                        <input type="password" name="user[confirm_password]"
                               placeholder="Password Confirm"
                               id="input-billing-confirm"
                               @if($errors->has('user.confirm_password'))
                               class="is-invalid avored-checkout-field form-control"
                               @else
                               class="form-control avored-checkout-field"
                                @endif
                        />

                        @if ($errors->has('user.confirm_password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user.confirm_password') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        @endif

        <div class="form-group">
            <label class="control-label" for="input-billing-phone">Phone</label>
            <input type="text" name="billing[phone]" value="{{ $phone }}" placeholder="Phone"
                   id="input-billing-phone"
                   @if($errors->has('billing.phone'))
                   class="is-invalid form-control avored-checkout-field"
                   @else
                   class="form-control avored-checkout-field"
                    @endif
            />
            @if ($errors->has('billing.phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('billing.phone') }}
                </div>
            @endif
        </div>
    </div>
</div>