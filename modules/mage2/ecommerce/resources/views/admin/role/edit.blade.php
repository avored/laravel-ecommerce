@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="card">
                <div class="card-header">
                    Edit Role
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">


                    @include('mage2-ecommerce::admin.role._fields')


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Role</button>
                            <a href="{{ route('admin.role.index') }}" class="btn">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection