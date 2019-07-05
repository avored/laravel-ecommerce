@extends('layouts.app')

@section('content')
<a-row :gutter="15" >
  <a-col :span="18" :offset="3">
    <a-row :gutter="15" justify="center" align="center">
      @foreach ($category->products as $product)
          <a-col :span="8">
            @include('category.card.product', ['product' => $product])
          </a-col>
      @endforeach
    </a-row>
  </a-col>
</a-row>
@endsection
