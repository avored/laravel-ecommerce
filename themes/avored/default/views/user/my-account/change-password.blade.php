@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<h3>{{ __('auth.change_password') }} </h3>
<div class="clearfix">&nbsp;</div>

    <form action="{{ route('my-account.change-password.post') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>{{ __('auth.current_password') }} <span class="text-danger">*</span></label>
            <input type="password" name="current_password" @if($errors->has('current_password')) class="is-invalid form-control" @else class="form-control" @endif />
                @if ($errors->has('current_password'))
                   <div class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                    </div>
                @endif
        </div>

        <div class="form-group">
            <label>{{ __('auth.new_password') }} <span class="text-danger">*</span></label>
            <input type="password" name="password"
                @if($errors->has('password')) class="is-invalid form-control" @else  class="form-control" @endif />
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>{{ __('auth.confirm_password') }}  <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" @if($errors->has('password_confirmation')) class="is-invalid form-control" 
                        @else class="form-control" @endif/>
                        
                        @if ($errors->has('password_confirmation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">{{ __('auth.save') }}</button>
               </div>              
        </form>
@endsection
