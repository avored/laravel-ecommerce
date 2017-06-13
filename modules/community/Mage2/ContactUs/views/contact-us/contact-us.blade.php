@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Contact US</h2>

            <div class="contact-us-wrapper">
                <form action="{{ route('contact-us.post') }}" method="post">
                    {{ csrf_field() }}


                    @if(!Auth::check())
                        <div class="form-group col s6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" value=""/>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col s6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" value=""/>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email"/>
                            @if ($errors->has('email'))
                                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                    @else
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @endif

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone"/>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" name="message"></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                            <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection