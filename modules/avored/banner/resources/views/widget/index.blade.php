
<div class="row">
    <div class="col-md-12">
        <div class="h2">Home Page Banner</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div id="avored-banner-slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">

            @foreach($banners as $banner)
                @php
                    if($loop->index ==0) {
                        $class = "active";
                    } else {
                        $class = "";
                    }
                @endphp
                <li data-target="#avored-banner-slider" data-slide-to="{{ $loop->index }}" class="{{ $class }}" ></li>
            @endforeach

        </ol>


        <div class="carousel-inner" style="max-height: 400px" role="listbox">

            @foreach($banners as $banner)
                @php
                    if($loop->index ==0) {
                        $class = "active";
                    } else {
                        $class = "";
                    }
                @endphp


                <div class="carousel-item {{ $class }}">
                    <img class="d-block img-fluid" style="max-height: 300px;width: 100%"
                         src="{{ asset($banner->image_path) }}"
                         alt="{{ $banner->alt_text }}">

                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $banner->alt_text }}</h3>

                        @if(null != $banner->url)
                        <a class="btn btn-primary" href="{{ $banner->url }}">Shop Now</a>
                        @endif
                    </div>
                </div>

            @endforeach

        </div>
        <a class="carousel-control-prev" href="#avored-banner-slider"  data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#avored-banner-slider" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    </div>
</div>