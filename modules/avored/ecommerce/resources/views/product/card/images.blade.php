
<input type="file" class="product-image-element form-control" data-token="{{ csrf_token() }}"
        >

<div class="product-image-list">

    @if(isset($model) && $model->images()->get()->count() > 0)
        @foreach($model->images()->get() as $image)
            <?php $class = ($image->is_main_image == 1) ? "active" : ""; ?>
            <div class="image-preview">
                <div class="actual-image-thumbnail">
                    <img class="img-thumbnail img-tag img-responsive"
                        data-path="{{ $image->path->relativePath }}"
                        src="{{ ($image->path->smallUrl) }}"/>
                    <input type="hidden" name="image[{{ $image->id }}][path]" value="{{ $image->path->relativePath }}"/>
                    @if($image->is_main_image)
                        <input type="hidden" class="is_main_image_hidden_field"
                               name="image[{{ $image->id }}][is_main_image]" value="1"/>
                    @else
                        <input type="hidden" class="is_main_image_hidden_field"
                               name="image[{{ $image->id }}][is_main_image]" value="0"/>
                    @endif
                </div>
                <div class="image-info">
                    <div class="image-title">
                        {{ $image->path->name() }}
                    </div>
                    <div class="actions">
                        <div class="action-buttons pull-right">

                            <button type="button"
                                    class="btn is_main_image_button {{ $class }} selected-icon"
                                    title="Select as Main Image">
                                <i class="fas fa-check-square"></i>
                            </button>
                            <button type="button" class="destroy-image btn btn-xs btn-default" title="Remove file">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @endif
</div>
@push('styles')
<style>

    .image-preview {
        position: relative;
        display: table;
        margin: 8px;
        border: 1px solid #ddd;
        box-shadow: 1px 1px 5px 0 #a2958a;
        padding: 6px;
        float: left;
        text-align: center;
    }

    .image-preview .actual-image-thumbnail {
        height: 170px;
    }

    .image-preview .image-info .active.selected-icon {
        color: #00dd00;
    }

    .image-preview .image-info .image-title {
        margin-bottom: 15px;
    }

    .image-preview .image-info {
        position: relative;
        height: 70px;
    }
</style>
@endpush

@push('scripts')
<script>
    jQuery(document).ready(function () {


        jQuery(document).on('click', '.product-image-list .is_main_image_button', function (e) {
            e.preventDefault();
            //jQuery(this).toggleClass('active');

            //x = this;

            //var mainImageSrc = jQuery(this).parents('.image-preview:first').find('img').attr('src');
            //jQuery('.top-header img').attr('src', mainImageSrc);

            //console.info(mainImageSrc);

            jQuery('.product-image-list .is_main_image_button').removeClass('active');
            jQuery('.product-image-list .is_main_image_hidden_field').val(0);


            if (jQuery(this).hasClass('active')) {

                jQuery(this).removeClass('active');
                jQuery(this).parents('.image-preview:first').find('.is_main_image_hidden_field').val(0);
            } else {
                jQuery(this).addClass('active');
                jQuery(this).parents('.image-preview:first').find('.is_main_image_hidden_field').val(1);
            }

        });
        jQuery(document).on('click', '.product-image-list .image-preview .destroy-image', function (e) {


            var token = jQuery('.product-image-element').attr('data-token');
            var path = jQuery(e.target).parents('.image-preview:first').find('.img-tag').attr('data-path');
            var data = {_token: token, path: path};
            jQuery.ajax({
                url: '{{ URL::to("/admin/product-image/delete")}}',
                data: data,
                dataType: 'json',
                type: 'post',
                success: function (response) {
                    if (response.success == true) {
                        jQuery(e.target).parents('.image-preview:first').remove();
                    }

                }
            })
        });
        jQuery('.product-image-element').change(function (e) {
            var files = e.target.files;

            if (files.length <= 0) {
                return;
            }

            var formData = new FormData();

            formData.append('_token', jQuery(e.target).attr('data-token'));
            for (var i = 0, file; file = files[i]; ++i) {
                formData.append('image', file);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ URL::to("/admin/product-image/upload") }}', true);
            xhr.onload = function (e) {
                if (this.status == 200) {

                    jQuery('.product-image-list').append(this.response);
                    if (jQuery('.product-image-list .image-preview').length == 1) {
                        jQuery('.product-image-list .image-preview .is_main_image_button').trigger('click');
                    }
                }
            };

            xhr.send(formData);

            jQuery(".product-image-element").val('');
        });

    });
</script>
@endpush

