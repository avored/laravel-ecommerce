@extends('layouts.app')

@section('content')
<category-page
  current-url="{{ request()->url() }}"
  :filter-prop="{{ json_encode(request()->all()) }}"
  inline-template>
  
  <a-row :gutter="15" >
    <a-col :span="6">
      @include('category.card.filters')
    </a-col>
    <a-col :span="18">
      <a-row :gutter="15" justify="center" >
        @foreach ($categoryProducts as $product)
            <a-col :span="8">
              @include('category.card.product', ['product' => $product])
            </a-col>
        @endforeach
      </a-row>
    </a-col>
  </a-row>
</category-page>
@endsection
