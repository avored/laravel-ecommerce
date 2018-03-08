@extends('avored-ecommerce::admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="h1">{{ __("avored-ecommerce::lang.product.create.text") }}</div>
        </div>
    </div>
    <form
            id="product-save-form"
            action="{{ route('admin.product.store') }}"
            method="post"
            enctype="multipart/form-data">

        {{ csrf_field() }}

        @include("avored-ecommerce::forms.text",['name'=> 'name','label' => 'Name'])
        @include("avored-ecommerce::forms.select",['name'=> 'type','label' => 'Type',
                                                    'options' => ['BASIC' => 'Basic Product',
                                                                    'VARIATION' => 'Variable Product'
                                                                ]
                                                    ])


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create & Continue</button>
            <button type="button"
                    onclick="location='{{ route('admin.product.index') }}'"

                    class="btn">Cancel
            </button>
        </div>
    </form>
@endsection