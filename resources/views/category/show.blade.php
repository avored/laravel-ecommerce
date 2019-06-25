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
        <?php 
        //dd($product->main_image);
        ?>
          <a-col :span="8">
            <a-card>
              <img
                alt="example"
                src="{{ $product->main_image_url }}"
                slot="cover"
              />
              <template class="ant-card-actions" slot="actions">
                <a-tooltip placement="topLeft" >
                  <template slot="title">
                    <span>{{ __('Add To Cart') }}</span>
                  </template>
                  <a-icon type="shopping-cart"></a-icon>
                </a-tooltip>
                <a-tooltip placement="topLeft" >
                  <template slot="title">
                    <span>{{ __('Add To Wishlist') }}</span>
                  </template>
                  <a-icon type="heart"></a-icon>
                </a-tooltip>
              </template>
              <a-card-meta title="{{ $product->name }}">
              </a-card-meta>
            </a-card>
          </a-col>
      @endforeach
    </a-row>
  </a-col>
</a-row>
@endsection
