<div class="input-field col s12  file-field col s12 {{ $errors->has($key) ? ' has-error' : '' }}">
    <div class="btn">
        <span>{!! $label !!}</span>

        {!! Form::file('file',['class' => 'product-image-element form-control','data-token' => csrf_token()]) !!}
</div>

        <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
<br/>

<div class="product-image-list">
    @if(isset($product) && count($product->getProductImages()) > 0)
    @foreach($product->getProductImages() as $image)

    <div class="col s3 image-thumbnail" >
        <button type="button" class="close"><span>X</span></button>
        <img class="responsive-img" src="{{ asset("/uploads/catalog/images/". $image->value) }}"/>
        <input type="hidden" name="image[]" value="{{  $image->value }}" />
    </div>
    @endforeach
    @endif


</div>
<div class="clearfix"></div>



<script>
    jQuery(document).ready(function () {

        jQuery(document).on('click', '.product-image-list .image-thumbnail .close', function (e) {


            var token = jQuery('.product-image-element').attr('data-token');
            var path = jQuery(e.target).parents('.image-thumbnail:first').find('img').attr('src');
            var data = {_token: token, path: path};
            jQuery.ajax({
                url: '{{ URL::to("/admin/product-image/delete")}}',
                data: data,
                type: 'post',
                success: function (response) {
                    if (response == 'success') {

                        jQuery(e.target).parents('.image-thumbnail:first').remove();
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