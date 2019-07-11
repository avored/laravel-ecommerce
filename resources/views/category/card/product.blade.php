<a-card hoverable class="product-card">
    <a slot="cover" href="{{ route('product.show', $product->slug) }}">
        <img
        alt="example"
        class="main-image"
        src="{{ $product->main_image_url }}"
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
               
        <a-card-meta class="product-meta" title="{{ $product->name }}">
            <template class="price" slot="description">
                {{ session()->get('default_currency')->symbol }}{{ number_format($product->price, 2) }}
            </template>
        </a-card-meta>
    </a>
</a-card>
