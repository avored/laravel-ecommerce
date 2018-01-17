@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Property</div>
                <div class="card-body">

                    <form action="{{ route('admin.property.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        @include('mage2-ecommerce::admin.property._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Property</button>
                            <a href="{{ route('admin.property.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection