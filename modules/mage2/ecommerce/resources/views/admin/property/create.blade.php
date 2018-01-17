@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create Property</div>
                    <div class="card-body">

                        <form action="{{ route('admin.property.store') }}" method="post">
                            {{ csrf_field() }}


                            @include('mage2-ecommerce::admin.property._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create Property</button>
                                <a href="{{ route('admin.property.index') }}" class="btn">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection