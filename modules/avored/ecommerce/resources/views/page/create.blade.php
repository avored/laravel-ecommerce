@extends('avored-ecommerce::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Create Page</div>
                    <div class="card-body">

                        <form action="{{ route('admin.page.store') }}" method="post">
                            @csrf

                            @include('avored-ecommerce::page._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create Page</button>
                                <a href="{{ route('admin.page.index') }}" class="btn">Cancel</a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection