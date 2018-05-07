@extends('avored-ecommerce::layouts.app')

@section('content')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('avored-ecommerce::property.create') }}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.property.store') }}" method="post">
                            {{ csrf_field() }}

                            @include('avored-ecommerce::property._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{ __('avored-ecommerce::property.create') }}</button>
                                <a href="{{ route('admin.property.index') }}" class="btn">{{ __('avored-ecommerce::lang.cancel') }}</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

@endsection