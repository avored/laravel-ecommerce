@extends('front.master')

@section('content')

    <div class="col-md-3">
        <!-- *** MENUS AND FILTERS ***
_________________________________________________________ -->
        <div class="panel panel-default sidebar-menu">

            <div class="panel-heading">
                <h3 class="panel-title">Categories</h3>
            </div>

            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked category-menu">
                    <!-- !! Category::renderCategoryTree($categoryTree) !! -->
                </ul>

            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="box">
            <h1>{{ $category->name }}</h1>

            <p>{{ $category->description }}</p>
        </div>

        <div class="row products">

            @foreach($category->product()->get() as $product)
                <?php
                    //var_dump($product->slug);die;
                        ?>
                <div class="col-md-4 col-sm-6">
                    <div class="product">
                        <div class="image-container">
                            <div class="image">

                                <a href="{!! route('product.view',$product->slug )  !!}"
                                   title="{{ $product->name }}" >
                                    <img src="{{ $product->getImagePath() }}"
                                         alt="" class="img-responsive">
                                </a>

                            </div>
                        </div>

                        <div class="text">
                            <h3><a href="{!! url(route('product.view',$product->slug ))  !!}"  
                                   title="{{ $product->name }}">{{ $product->name }}</a></h3>

                            <?php
                            $price = $product->price()->get()->first();
                            $productPrice = (isset($price)) ? $price->sale_price : 0.00;
                            ?>
                            <p class="price">{{ $productPrice }}</p>

                            <p class="buttons">
                                <a href="{!! url(route('product.view',$product->slug ))  !!}" class="btn btn-default">View
                                    detail</a>
                                 {!! Form::open(array(
                                        'url' => url('/cart/addtocart/'. $product->id),
                                        'method' => 'post' , 
                                        'class' => 'addtocartForm')
                                        ) !!}
                            <a href="#" class="btn btn-success"
                                    onclick="jQuery(this).parents('form:first').submit()">Add To Cart</a>
                        {!! Form::close() !!}
                            </p>
                        </div>
                        <!-- /.text -->
                    </div>
                    <!-- /.product -->
                </div>
            @endforeach


        </div>


    </div>

@endsection