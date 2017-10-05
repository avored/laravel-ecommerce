@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Category</div>
                <div class="card-body">

                    <form action="{{ route('admin.category.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">


                        @include('mage2-ecommerce::admin.category._fields')

                        <button type="submit" disabled class="btn category-save-button">Edit Category</button>

                        <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection