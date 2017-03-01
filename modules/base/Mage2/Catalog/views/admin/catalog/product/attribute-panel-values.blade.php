<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
               aria-controls="collapseOne">
                Available Variations
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">

            @if($attribute->field_type == "SELECT")

                @foreach($attribute->attributeDropdownOptions as $dropdownValue)

                    <div class="col-md-12 single-option-box"
                         style="border: 1px solid #ccc; padding: 10px;margin-bottom: 10px">
                        <label>{{ $dropdownValue->display_text }}</label>

                        <div class="col-md-12 form-group">
                            <label>SKU</label>
                            <input type="text" name="attribute[{{ $dropdownValue->id }}][sku]" class="form-control"/>
                        </div>
                        <div class="col-md-12">
                            <label>URL</label>
                            <input type="text" name="attribute[{{ $dropdownValue->id }}][url]" class="form-control"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="col-md-4 form-group">
                                <label>Image</label>
                                <input type="file" name="attribute[{{ $dropdownValue->id }}][image]"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                <label>Qty</label>
                                <input type="text" name="attribute[{{ $dropdownValue->id }}][qty]"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-4">
                                <label>Price</label>
                                <input type="text" name="attribute[{{ $dropdownValue->id }}][price]"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endforeach

            @endif

        </div>
    </div>
</div>