@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">
                    Edit State
                    <!--<small>Sub title</small> -->
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.state.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        @include('mage2-ecommerce::admin.state._fields')

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update State</button>
                        <a href="{{ route('admin.state.index') }}" class="btn">Cancel</a>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection