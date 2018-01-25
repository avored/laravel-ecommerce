@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    Edit Option
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.option.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                    @include('mage2-ecommerce::admin.option._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Option</button>
                            <a href="{{ route('admin.option.index') }}" class="btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection