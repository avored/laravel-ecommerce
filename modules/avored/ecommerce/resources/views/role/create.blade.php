@extends('avored-ecommerce::layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('avored-ecommerce::role.role-create') }}</div>
                <div class="card-body">
                    <form action="{{ route('admin.role.store') }}" method="post">
                        {{ csrf_field() }}

                        @include('avored-ecommerce::role._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('avored-ecommerce::role.role-create') }}</button>
                            <a href="{{ route('admin.role.index') }}" class="btn">{{ __('avored-ecommerce::lang.cancel') }}</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection