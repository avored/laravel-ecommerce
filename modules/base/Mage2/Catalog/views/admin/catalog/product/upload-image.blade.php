<div class="col s3 image-thumbnail" >
    <button type="button" class="close"><span>X</span></button>
    <img class="responsive-img" src="{{ asset($path) }}"/>
    <input type="hidden" name="image[]" value="{{ $dbPath }}" />
</div>