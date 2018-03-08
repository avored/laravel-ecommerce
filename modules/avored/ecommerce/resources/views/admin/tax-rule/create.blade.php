@extends('avored-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    {{ __('avored-ecommerce::tax-rule.create') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tax-rule.store') }}" method="post">
                    {{ csrf_field() }}

                    @include('avored-ecommerce::admin.tax-rule._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('avored-ecommerce::tax-rule.create') }}</button>
                            <a href="{{ route('admin.tax-rule.index') }}" class="btn">{{ __('avored-ecommerce::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection