@extends('layouts.app')

@section('meta_title','Upload My Account E commerce')
@section('meta_description','Upload My Account E commerce')

@section('content')
    <div class="row profile">
        <div class="col-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-9">

            <div class="card">
                <div class="card-header">
                    Profile Image Upload
                </div>
                <div class="card-body">
                    <form action="{{ route('my-account.upload-image.post') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file"
                                   @if($errors->has('profile_image'))
                                   class="is-invalid form-control"
                                   @else
                                   class="form-control"
                                   @endif

                            name="profile_image" id="profile_image" />
                            @if ($errors->has('profile_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('profile_image') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Upload Image</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
