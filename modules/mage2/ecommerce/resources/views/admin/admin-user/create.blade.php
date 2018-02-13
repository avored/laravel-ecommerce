@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('mage2-ecommerce::user.admin-user-create') }}
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.admin-user.store') }}" method="post">
                        {{ csrf_field() }}

                        @include('mage2-ecommerce::admin.admin-user._fields',
                                    ['editMethod' => false,'roles' => $roles]
                                    )

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('mage2-ecommerce::user.admin-user-create') }}
                            </button>
                            <a href="{{ route('admin.admin-user.index') }}" class="btn">
                                {{ __('mage2-ecommerce::lang.cancel') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection