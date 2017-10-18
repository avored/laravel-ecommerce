@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row justify-content-center" >
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    Create Product Attribute
                </div>
                <div class="card-body">


                    <form method="post" action="{{ route('admin.attribute.store') }}">
                        {{ csrf_field() }}

                    @include('mage2-ecommerce::admin.attribute._fields')

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Attribute</button>
                            <a href="{{ route('admin.attribute.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection