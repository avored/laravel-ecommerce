@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('mage2-ecommerce::property.create') }}</div>
                    <div class="card-body">

                        <form action="{{ route('admin.property.store') }}" method="post">
                            {{ csrf_field() }}

                            @include('mage2-ecommerce::admin.property._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">{{ __('mage2-ecommerce::property.create') }}</button>
                                <a href="{{ route('admin.property.index') }}" class="btn">{{ __('mage2-ecommerce::lang.cancel') }}</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection