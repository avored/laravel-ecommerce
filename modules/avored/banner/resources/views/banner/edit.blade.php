@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('avored-banner::banner.banner-update') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banner.update', $model->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')

                        @include('avored-banner::banner._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-banner::banner.banner-update') }}
                            </button>
                            <a href="{{ route('admin.banner.index') }}" class="btn">
                                {{ __('avored-framework::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection