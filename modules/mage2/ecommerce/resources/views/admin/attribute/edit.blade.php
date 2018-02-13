@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('mage2-ecommerce::attribute.edit') }}</div>
                <div class="card-body">

                    <form action="{{ route('admin.attribute.update', $model->id) }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">

                        @include('mage2-ecommerce::admin.attribute._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">{{ __('mage2-ecommerce::attribute.edit') }}</button>
                            <a href="{{ route('admin.attribute.index') }}" class="btn">{{ __('mage2-ecommerce::lang.cancel') }}</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection