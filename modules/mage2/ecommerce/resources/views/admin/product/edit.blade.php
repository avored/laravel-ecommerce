@extends('mage2-ecommerce::admin.layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="h1">Edit Product</div>
            </div>
        </div>

        <?php
        $productCategories = $model->categories()->get()->pluck('id')->toArray();
        ?>
        <form id="product-save-form"
              action="{{route('admin.product.update', $model->id)}}"
              enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">

        <div class="row" id="product-save-accordion" data-children=".product-card">
            <div class="col-12 mb-2 mt-2">
                <div class="card product-card  mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#basic">
                    <div class="card-header">
                        Basic Details
                    </div>
                    </a>
                    <div class="card-body collapse show" id="basic">
                        @include('mage2-ecommerce::admin.product.card.basic', ['editMethod' => true])
                    </div>
                </div>

                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#images">
                    <div class="card-header">
                        Images
                    </div>
                    </a>
                    <div class="card-body collapse" id="images">
                        @include('mage2-ecommerce::admin.product.card.images')
                    </div>
                </div>


                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#seo">

                    <div class="card-header">

                        SEO


                    </div>
                    </a>
                    <div class="card-body collapse" id="seo">
                        @include('mage2-ecommerce::admin.product.card.seo')
                    </div>
                </div>

                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#property">
                    <div class="card-header">
                        Property
                    </div>
                    </a>
                    <div class="card-body collapse" id="property">
                        @include('mage2-ecommerce::admin.product.card.property')
                    </div>
                </div>

                <div class="card product-card mb-2 mt-2">
                    <a data-toggle="collapse" data-parent="#product-save-accordion"
                       class="float-right" href="#attribute">
                        <div class="card-header">
                            Attribute
                        </div>
                    </a>
                    <div class="card-body collapse" id="attribute">
                        @include('mage2-ecommerce::admin.product.card.attribute')
                    </div>
                </div>


                @foreach(Tabs::all() as $key => $tab)

                    <div class="card product-card mb-2 mt-2">
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#{{ $key }}">
                        <div class="card-header">
                            {{ $tab->label }}
                        </div>
                        </a>
                        <div class="card-body collapse" id="{{ $key }}">
                            @include($tab->view)
                        </div>
                    </div>

                @endforeach


            </div>
        </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="jQuery('#product-save-form').submit()">
                    Edit Product
                </button>
                <button type="button" class="btn" onclick="location='{{ route('admin.product.index') }}'">
                    Cancel
                </button>
            </div>

        </form>
    </div>
@endsection