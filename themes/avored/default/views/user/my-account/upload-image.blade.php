@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')

<h3>{{ __('profile.upload_image') }}</h3>
<div class="clearfix">&nbsp;</div>

<form action="{{ route('my-account.upload-image.post') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="custom-file">
                    <input type="file" name="profile_image" id="profile_image" 
                        @if($errors->has('profile_image')) class="is-invalid form-control" @else class="custom-file-input" @endif>
                            <label class="custom-file-label" for="inputGroupFile01">{{ __('profile.choose_file') }}</label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">{{ __('profile.upload_image') }}</button>
            </div>
        </div>
</form>
@endsection
