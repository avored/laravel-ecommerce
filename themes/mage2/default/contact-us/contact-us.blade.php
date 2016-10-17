@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h2>Contact US</h2>

            <div class="contact-us-wrapper">
                <form action="{{ route('contact-us.post') }}" method="post">
                    {{ csrf_field() }}


                    @if(!Auth::check())
                    <div class="input-field col s6">
                        <label>First Name</label>
                        <input type="text" name="first_name" value=""/>
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-field col s6">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value=""/>
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>

                    <div class="input-field">
                        <label>Email</label>
                        <input type="text" name="email"/>
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    @else
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endif

                    <div class="input-field">
                        <label>Phone</label>
                        <input type="text" name="phone"/>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <label>Message</label>
                        <textarea class="materialize-textarea" name="message"></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field">
                        <button class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection