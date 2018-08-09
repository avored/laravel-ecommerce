@extends('avored-framework::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>{{ __('avored-banner::banner.banner-create') }}</h1>

            <div class="card">
                <div class="card-body">

                    <form action="{{ route('admin.banner.store') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        @include('avored-banner::banner._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('avored-banner::banner.banner-create') }}
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