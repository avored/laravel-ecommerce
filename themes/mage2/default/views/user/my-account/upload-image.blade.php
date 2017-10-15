@extends('layouts.app')

@section('meta_title','Upload My Account E commerce')
@section('meta_description','Upload My Account E commerce')

@section('content')
    <div class="container">
    <div class="row profile">
        <div class="col-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    Profile Image Upload
                </div>
                <div class="card-body">
                    <form action="{{ route('my-account.upload-image.post') }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" id="profile_image" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Upload Image</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
