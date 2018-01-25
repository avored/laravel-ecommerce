@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">

                Edit TaxRule
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tax-rule.update', $model->id) }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">



                @include('mage2-ecommerce::admin.tax-rule._fields')

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update Tax rule</button>
                        <a href="{{ route('admin.tax-rule.index') }}" class="btn">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection