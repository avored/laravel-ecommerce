@extends('layouts.app')

@section('breadcrumb')
<a-breadcrumb style="margin: 16px 0">
    <a-breadcrumb-item>{{ __('Home') }}</a-breadcrumb-item>
</a-breadcrumb>
@endsection
@section('content')
{!! $page->getContent() !!}
<h1>{{ __('AvoRed Special Week') }}</h1>
<a-row :gutter="15">
  @foreach ($products as $product)
      <a-col :span="6" class="product-cards-list">
        @include('category.card.product', ['product' => $product])
      </a-col>
  @endforeach
</a-row>
@endsection
