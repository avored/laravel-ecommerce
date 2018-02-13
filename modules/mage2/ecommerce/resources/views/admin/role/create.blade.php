@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('mage2-ecommerce::role.role-create') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.role.store') }}" method="post">
                        {{ csrf_field() }}

                        @include('mage2-ecommerce::admin.role._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('mage2-ecommerce::role.role-create') }}</button>
                            <a href="{{ route('admin.role.index') }}" class="btn">{{ __('mage2-ecommerce::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection