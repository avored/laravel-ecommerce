@extends('layouts.app')

@section('content')
<a-carousel vertical>
    <div><h3>AvoRed E commerce</h3></div>
    <div><h3>PHP Language</h3></div>
    <div><h3>Laravel Framework</h3></div>
  </a-carousel>
<h1>{{ __('AvoRed Special Week') }}</h1>
<a-row :gutter="15">
  @foreach ($products as $product)
      <a-col :span="6">
        @include('category.card.product', ['product' => $product])
      </a-col>
  @endforeach
</a-row>
@endsection
