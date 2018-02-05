@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Upload Theme
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.theme.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="theme_zip_file">Upload Theme file</label>
                            <input type="file" class="form-control" name="theme_zip_file" id="theme_zip_file"/>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload Theme</button>
                        </div>

                    </form>


                </div>
            </div>


        </div>
    </div>
@endsection