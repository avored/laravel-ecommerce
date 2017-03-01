<div class="panel panel-default">
    <div class="panel-heading">
        <span>Options</span>
    </div>


    <div class="panel-body">
        Product Option Panel


        <div class="col-md-12">

            <label>Please Select Option</label>
                <span class="input-group">

                    <select class="attribute-select-field form-control" data-token="{{ csrf_token() }}">
                        @foreach($productAttributes as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                 <a href="#" class="add-product-attribute input-group-addon">Add</a>
                </span>
        </div>

        <div class="clearfix"></div>
        <hr/>

        <div class="panel-group" id="attribute-accordion" role="tablist" aria-multiselectable="true">


        </div>


    </div>

</div>
<script>

    jQuery(document).ready(function () {

        jQuery(document).on('click','.add-product-attribute', function(e) {
            e.preventDefault();

            if(jQuery('.attribute-select-field').val() != "") {


                var data = {id: jQuery('.attribute-select-field').val(), _token : jQuery('.attribute-select-field').attr('data-token') }

                jQuery.ajax({
                    url : "{{ route('admin.product-attribute.get-attribute')  }}",
                    method : "post",
                    data: data,
                    success: function(response) {

                        jQuery('#attribute-accordion').append(response);


                    }
                })


            }
            else {
                alert('Please Select Attribute First');
            }


        });

    })
</script>