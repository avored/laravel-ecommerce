<div class="col-md-3 image-thumbnail">
    <button type="button" class="close"><span>X</span></button>
    <img class="img-responsive" src="{{ $image->smallUrl }}"/>
    <input type="hidden" name="image[{{ $tmp }}][]" value="{{ $image->relativePath }}"/>
</div>