@extends('layouts.app')

@section('content')
<div class="row">
    @if(count($featuredProducts) <= 0)
    <p>Sorry No Feature Product</p>
    @else

    <div class="col-md-12">

        <div class="main-wrap">
            <h4 class="title">Mage2 Ecommerce Home Page</h4>
        </div>
        

    </div>
    @endif
</div>
@endsection
