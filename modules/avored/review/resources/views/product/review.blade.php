<div class="row ">

    <div class="col-12 mt-3">

        <div class="main-title clearfix">
            <span class="float-left h1">
                Reviews
            </span>

            <span class="float-right">
                <a href="#" class="btn btn-primary">Write Review</a>
            </span>

        </div>
        <div class="review-list">


            @if(null != $productReviews && $productReviews->count() > 0)
                @foreach($productReviews as $productReview)
                    <div class="card">
                        <div class="card-body">
                            <p class="review-stars">
                                <select  class="single-review-stars">

                                    <option
                                            @if($productReview->star == 1)
                                                selected='selected'
                                            @endif
                                            value="1">1</option>
                                    <option  @if($productReview->star == 2)
                                                selected='selected'
                                             @endif
                                             value="2">2</option>
                                    <option  @if($productReview->star == 3)
                                                selected='selected'
                                             @endif
                                             value="3">3</option>
                                    <option  @if($productReview->star == 4)
                                                selected='selected'
                                             @endif
                                             value="4">4</option>
                                    <option   @if($productReview->star == 5)
                                                selected='selected'
                                              @endif
                                              value="5">5</option>
                                </select>
                            </p>
                            <p class="text-muted">{{ $productReview->content }}</p>
                        </div>
                    </div>

                @endforeach

            @endif


            <div class="review-form mt-3">
                <div class="h5">Write a Review</div>

                <form method="post" action="{{ route('review.store') }}">

                    @csrf

                    <div class="form-group">

                        <label for="star">Please select star</label>
                        <select name="star" class="form-control {{ $errors->has('star') ? ' is-invalid' : '' }}"
                                id="star">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        @if ($errors->has('star'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('star') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="content">Review Text</label>
                        <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                  name="content"></textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif

                    </div>

                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>

                </form>

            </div>
        </div>

    </div><!-- END REVIEW COL-12 -->
</div><!-- END REVIEW ROW-->
@push('styles')
    <link href="{{ asset('vendor/avored-default/css/css-stars.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script type="application/javascript"
            src="{{ asset('vendor/avored-default/js/jquery.barrating.min.js') }}"></script>
    <script>
        $(function () {

            $('.single-review-stars').barrating({
                theme: 'css-stars'
            });
            $('#star').barrating({
                theme: 'css-stars'
            });
        })

    </script>
@endpush