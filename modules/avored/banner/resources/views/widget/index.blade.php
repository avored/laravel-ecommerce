<div>
    <a-carousel class="carousel" vertical>
        @foreach ($banners as $banner)  
            <div class="banner-{{ $banner->id }}">
                <a href="{{ asset($banner->url) }}">
                    <img 
                        style="width:100%"
                        src="{{ '/storage/' . $banner->image_path }}"
                        alt="{{ $banner->alt_text }}" />
                </a>
            </div>
            
        @endforeach
       
    </a-carousel>
</div>
