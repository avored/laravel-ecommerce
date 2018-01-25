@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    Create Tax Rule
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tax-rule.store') }}" method="post">
                    {{ csrf_field() }}

                    @include('mage2-ecommerce::admin.tax-rule._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Create Tax Rule</button>
                            <a href="{{ route('admin.tax-rule.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection