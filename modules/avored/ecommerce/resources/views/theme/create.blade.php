@extends('avored-ecommerce::layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-ecommerce::theme.theme-upload') }}
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ route('admin.theme.store') }}"
                          enctype="multipart/form-data">

                        @csrf()

                        <div class="form-group">
                            <label for="theme_zip_file">{{ __('avored-ecommerce::theme.theme-upload-file') }}</label>
                            <input type="file" class="form-control" name="theme_zip_file" id="theme_zip_file"/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('avored-ecommerce::theme.theme-upload') }}
                            </button>

                            <a href="{{ route('admin.theme.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection