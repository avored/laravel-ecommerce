<div class="panel-default">
    <div class="panel-heading">Images</div>
    <div class="panel-body">

        {!! Form::file('file','Images',['class' => 'product-image-element form-control','data-token' => csrf_token()]) !!}


        <div class="product-image-list">

            @if(isset($product) && count($product->images()->get()->count()) > 0)
                @foreach($product->images()->get() as $image)
                    <div class="image-preview">
                        <div class="actual-image-thumbnail">
                            <img class="img-thumbnail img-tag img-responsive" src="{{ ($image->path->smallUrl) }}"/>
                            <input type="hidden" name="image[{{ $image->id }}][]" value="{{ $image->path->smallUrl }}"/>
                        </div>
                        <div class="image-info">
                            <div class="image-title">
                                XYZ.jpg
                            </div>
                            <div class="actions">
                                <div class="action-buttons pull-right">
                                    <button type="button" class="btn selected-icon btn-xs btn-default" title="Select as Main Image">
                                        <i class="glyphicon glyphicon-ok"></i>
                                    </button>
                                    <button type="button" class="destroy-image btn btn-xs btn-default" title="Remove file" >
                                        <i class="glyphicon glyphicon-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>
    </div>
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

        jQuery(document).on('click', '.product-image-list .image-preview .destroy-image', function (e) {


            var token = jQuery('.product-image-element').attr('data-token');
            var path = jQuery(e.target).parents('.image-preview:first').find('.img-tag').attr('src');
            var data = {_token: token, path: path};
            jQuery.ajax({
                url: '{{ URL::to("/admin/product-image/delete")}}',
                data: data,
                type: 'post',
                success: function (response) {
                    if (response == 'success') {
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
                }
            };

            xhr.send(formData);

            jQuery(".product-image-element").val('');
        });

    });
</script>
@endpush

