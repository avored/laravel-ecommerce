@php
    $image = $product->image;
    $imageType = (isset($imageType)) ? $imageType : "smallUrl";
@endphp

@if(NULL !== $image)
    <div class="product-images-wrapper">
        <div class="main-media" style="display: block">
            <img alt="{{ $product->name }}"
                 style="max-height: 300px;"
                 class="card-img-top img-fluid"
                 src="{{ $image->$imageType }}"/>
        </div>

        @if(isset($extraImage) && true == $extraImage)
            <div id="product-extra-media" class="carousel mt-3 carousel-multi slide" data-interval="false" data-ride="carousel">

            <div class="carousel-inner" role="listbox">
                @foreach($product->images as $productImage)
                    @php
                        if(0 == $loop->index){
                            $class= "active";

                        } else {
                            $class= "";
                        }
                    @endphp
                    <div class="carousel-item {{ $class }}">
                        <div class="media media-card">
                            <img src="{{ $productImage->path->smallUrl }}" data-main-image="{{ $productImage->path->url }}" class="img-thumbnail"/>
                        </div>
                    </div>
                @endforeach
            </div>

            <a class="carousel-control-prev" href="#product-extra-media" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#product-extra-media" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
        @endif

    </div>
@endif
@if(isset($extraImage) && true == $extraImage)
@push('scripts')
    <script>

        jQuery(document).ready(function () {

            jQuery('.carousel.carousel-multi .carousel-item').each(function () {
                var next = jQuery(this).next();
                if (!next.length) {
                    next = jQuery(this).siblings(':first');
                }
                next.children(':first-child').clone().attr("aria-hidden", "true").appendTo(jQuery(this));

                if (next.next().length > 0) {
                    next.next().children(':first-child').clone().attr("aria-hidden", "true").appendTo(jQuery(this));
                }
                else {
                    jQuery(this).siblings(':first').children(':first-child').clone().appendTo(jQuery(this));
                }
            });

            jQuery('#product-extra-media .media-card img').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var imageUrl = jQuery(this).attr('data-main-image');
                jQuery('.product-images-wrapper .main-media img').attr('src', imageUrl);
            }) ;


        });


    </script>
@endpush
@endif