<div class="image-preview">
    <div class="actual-image-thumbnail">
        <img class="img-thumbnail img-tag img-responsive" src="{{ $image->smallUrl }}"/>
        <input type="hidden" name="image[{{ $tmp }}][path]" value="{{ $image->relativePath }}"/>
        <input type="hidden" class="is_main_image_hidden_field" name="image[{{ $tmp }}][is_main_image]" value="0"/>

    </div>
    <div class="image-info">
        <div class="image-title">
            {{ $image->name() }}
        </div>
        <div class="actions">
            <div class="action-buttons pull-right">

                <button type="button"
                        class="btn is_main_image_button  selected-icon"
                        title="Select as Main Image">
                        <i class="fas fa-check-square"></i>
                </button>
                <button type="button" class="destroy-image btn btn-xs btn-default" title="Remove file" >
                    <i class="fas fa-trash-alt text-danger"></i>
                </button>
            </div>
        </div>
    </div>
</div>