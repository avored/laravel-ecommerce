@extends('layouts.app')

@section('meta_title','Home Page')
@section('meta_description','Home Page')


@section('content')
    <div class="container">
        <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="/img/img1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Boxing Day Special</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="btn btn-primary" type="submit">
                            <span>Shop Now</span>
                        </button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="/img/img2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>New Arrivals</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="btn btn-primary" type="submit">
                            <span>Shop Now</span>
                        </button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="/img/img3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Clearance Items</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="btn btn-primary" type="submit">
                            <span>Shop Now</span>
                        </button>
                    </div>
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="min-height: 450px">

                @if($pageModel !== null)
                    {!! $pageModel->content !!}
                @else
                <div class="h1">Mage2 E commerce</div>
                <h6>Home Page</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
