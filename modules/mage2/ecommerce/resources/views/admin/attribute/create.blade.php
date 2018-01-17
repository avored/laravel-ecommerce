@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create Attribute</div>
                    <div class="card-body">

                        <form action="{{ route('admin.attribute.store') }}" method="post">
                            {{ csrf_field() }}


                            @include('mage2-ecommerce::admin.attribute._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create Attribute</button>
                                <a href="{{ route('admin.attribute.index') }}" class="btn">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection