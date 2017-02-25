<div class="panel panel-default">
    <div class="panel-heading">
        <span>Options</span>
    </div>


    <div class="panel-body">
        Product Option Panel


        <div class="col-md-12">

                <label>Please Select Option</label>
                <span class="input-group">


                    <select class="option-select-field form-control">
                        @foreach($productOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                 <a href="#" class="add-product-option input-group-addon">Add</a>
                </span>
        </div>

        <div class="clearfix"></div>
        <hr/>
        <div class="product-option-accordion">

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Color
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Blue</label>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Image</label>
                                        <input type="file" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Qty</label>
                                        <input class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Price</label>
                                        <span class="input-group">
                                        <input class="form-control">
                                        <a href="#" class="input-group-addon">Add</a>
                                           </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div>

</div>
<script>

    jQuery(document).ready(function () {

        jQuery(document).on('click','.add-product-option', function(e) {
            e.preventDefault();

            if(jQuery('.option-select-field').val() != "") {
                alert('perfect');
            }
            else {
                alert('Please Select Attribute First');
            }


        });

    })
</script>