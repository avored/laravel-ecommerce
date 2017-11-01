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
                    <div class="card-header">
                        Basic Details
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#basic">
                            <i class="oi oi-caret-top"></i>
                        </a>
                    </div>
                    <div class="card-body collapse show" id="basic">
                        @include('mage2-ecommerce::admin.product.card.basic', ['editMethod' => true])
                    </div>
                </div>

                <div class="card product-card mb-2 mt-2">
                    <div class="card-header">
                        Images
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#images">
                            <i class="oi oi-caret-top"></i>
                        </a>
                    </div>
                    <div class="card-body collapse" id="images">
                        @include('mage2-ecommerce::admin.product.card.images')
                    </div>
                </div>


                <div class="card product-card mb-2 mt-2">
                    <div class="card-header">
                        SEO
                        <a data-toggle="collapse" data-parent="#product-save-accordion"
                           class="float-right" href="#seo">
                            <i class="oi oi-caret-top"></i>
                        </a>
                    </div>
                    <div class="card-body collapse" id="seo">
                        @include('mage2-ecommerce::admin.product.card.seo')
                    </div>
                </div>

                <?php
                //dd($model->attributeGroups->count());
                ?>
                @if($model->attributeGroups->count() > 0)
                    <div class="card product-card mb-2 mt-2">
                        <div class="card-header">
                            Attributes
                            <a data-toggle="collapse" data-parent="#product-save-accordion"
                               class="float-right" href="#attributes">
                                <i class="oi oi-caret-top"></i>
                            </a>
                        </div>
                        <div class="card-body collapse" id="attributes">
                            @include('mage2-ecommerce::admin.product.card.attributes')
                        </div>
                    </div>

                @endif

                @if($model->type == "VARIATION")
                    <div class="card product-card mb-2 mt-2">
                        <div class="card-header">
                            Option
                            <a data-toggle="collapse" data-parent="#product-save-accordion"
                               class="float-right" href="#option">
                                <i class="oi oi-caret-top"></i>
                            </a>
                        </div>
                        <div class="card-body collapse" id="option">
                            @include('mage2-ecommerce::admin.product.card.option')
                        </div>
                    </div>

                @endif



                @foreach(Tabs::all() as $key => $tab)

                    <div class="card product-card mb-2 mt-2">
                        <div class="card-header">
                            {{ $tab->label }}
                            <a data-toggle="collapse" data-parent="#product-save-accordion"
                               class="float-right" href="#{{ $key }}">
                                <i class="oi oi-caret-top"></i>
                            </a>
                        </div>
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