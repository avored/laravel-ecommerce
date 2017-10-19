@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">Create Attribute Group</div>
                <div class="card-body">

                    <form action="{{ route('admin.attribute-group.store') }}" method="post">
                    {{ csrf_field() }}
                    @include('mage2-ecommerce::admin.attribute-group._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Create Attribute Group</button>
                            <a href="{{ route('admin.attribute-group.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection