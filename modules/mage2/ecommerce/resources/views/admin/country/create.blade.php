@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create Country
                    <!--<small>Sub title</small> -->
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.country.store') }}" method="post">
                    {{ csrf_field() }}

                    @include('mage2-ecommerce::admin.country._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Create Country</button>
                            <a href="{{ route('admin.country.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection