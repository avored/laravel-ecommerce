@extends('mage2-ecommerce::admin.layouts.app')


@section('content')

    <div class="row">
        <div class="col-12">

            <div class="h1 mt-1">Create Category</div>

            <form method="post" action="{{ route('admin.category.store') }}">

                <div class="card mt-3 mb-3">
                    <div class="card-header">Basic Details</div>
                    <div class="card-body">

                        @csrf()
                        @include('mage2-ecommerce::admin.category._fields')

                    </div>
                </div>

                <div class="card mt-3 mb-3">
                    <div class="card-header">SEO</div>
                    <div class="card-body">

                        @include('mage2-ecommerce::forms.text',['name' => 'meta_title','label' => 'Meta Title'])
                        @include('mage2-ecommerce::forms.textarea',['name' => 'meta_description','label' => 'Meta Description'])

                    </div>
                </div>

                <button type="submit" disabled class="btn category-save-button">Create Category</button>

                <a href="{{ route('admin.category.index') }}" class="btn btn-default">Cancel</a>
            </form>


        </div>
    </div>

@endsection