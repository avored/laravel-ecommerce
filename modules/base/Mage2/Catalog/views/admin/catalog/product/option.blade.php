<div class="panel panel-default">
    <div class="panel-heading">
        <span>Options</span>
    </div>


    <div class="panel-body">
        Product Option Panel


        <div class="col-md-12">

            <label>Please Select Option</label>
                <span class="input-group">


                    <select class="option-select-field form-control" data-token="{{ csrf_token() }}">
                        @foreach($productOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                 <a href="#" class="add-product-option input-group-addon">Add</a>
                </span>
        </div>

        <div class="clearfix"></div>
        <hr/>

        <div class="panel-group" id="option-accordion" role="tablist" aria-multiselectable="true">


        </div>


    </div>

</div>
<script>

    jQuery(document).ready(function () {

        jQuery(document).on('click','.add-product-option', function(e) {
            e.preventDefault();

            if(jQuery('.option-select-field').val() != "") {


                var data = {id: jQuery('.option-select-field').val(), _token : jQuery('.option-select-field').attr('data-token') }

                jQuery.ajax({
                    url : "{{ route('admin.product-attribute.options')  }}",
                    method : "post",
                    data: data,
                    success: function(response) {

                        jQuery('#option-accordion').append(response);


                    }
                })


            }
            else {
                alert('Please Select Attribute First');
            }


        });

    })
</script>