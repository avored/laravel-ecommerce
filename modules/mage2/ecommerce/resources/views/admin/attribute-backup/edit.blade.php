@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    Edit Product Attribute
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.attribute.update', $model->id) }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="_method" value="put">
                        @include('mage2-ecommerce::admin.attribute._fields')

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Attribute</button>
                            <a href="{{ route('admin.attribute.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection