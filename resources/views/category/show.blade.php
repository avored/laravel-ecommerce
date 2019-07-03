@extends('layouts.app')

@section('content')
<a-row :gutter="15">
  <a-col :span="6">
     <a-card title="Category Filter">
      <a href="#" slot="extra">more</a>
      <p>card content</p>
      <p>card content</p>
      <p>card content</p>
    </a-card>
  </a-col>
  <a-col :span="18">
    <a-row :gutter="15">
      @foreach ($category->products as $product)
          <a-col :span="8">
             
            <a-card>
             <a href="{{ route('product.show', $product->slug) }}">
                <img
                  alt="example"
                  src="{{ $product->main_image_url }}"
                  slot="cover"
                />
               </a>
              <template class="ant-card-actions" slot="actions">
                  
                      <form slot="title" method="post" action="{{ route('add.to.cart') }}">
                        @csrf
                        <a-button html-type="submit" type="primary" icon="shopping-cart"></a-button>
                        <input type="hidden" name="slug" value="{{ $product->slug }}" />
                        <input type="hidden" name="qty" value="1" />
                      </form>
                  
                <a-tooltip placement="topLeft" >
                  <template slot="title">
                    <span>{{ __('Add To Wishlist') }}</span>
                  </template>
                  <a-icon type="heart"></a-icon>
                </a-tooltip>
              </template>
              <a href="{{ route('product.show', $product->slug) }}">
                <a-card-meta title="{{ $product->name }}">
                </a-card-meta>
              </a>
            </a-card>
             
          </a-col>
      @endforeach
    </a-row>
  </a-col>
</a-row>
@endsection
