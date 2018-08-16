<form action="{{ route('review.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group {{ $errors->has('star') ? ' has-error' : '' }}">
        <p>Please Select Rating</p>

        <div class="col-12">
            <div id="rating123"></div>
        </div>

        <input type="hidden" name="star" id="rating" value=""/>
        @if ($errors->has('star'))
            <p>
                <span class="help-block">
                    <strong>{{ $errors->first('star') }}</strong>
                </span>
            </p>
        @endif
    </div>

    @if(!Auth::check())
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" />
        </div>
        
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" />
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" />
        </div>
    @endif

    <div class="form-group">
        <textarea name="comment" class="form-control"></textarea>
    </div>

    <input type="hidden" name="product_id" value="{{ $product->id }}"/>

    <div class="form-group">
        <button type="submit">Create Review</button>
    </div>

</form>

@push('scripts')
<script>
    $(function () {
        jQuery("#rating").rating({filledStar : '<i class="oi oi-star"></i>' , emptyStar : '<i class="oi oi-star"></i>'});
    })
</script>
@endpush
