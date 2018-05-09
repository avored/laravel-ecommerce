<div class="card card-default">
    <div class="card-header" role="tab" id="headingOne">
        <h4 class="card-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
               aria-controls="collapseOne">
                Available Variations

            </a>
        </h4>
    </div>
    <div id="collapseOne" class="card-collapse collapse in" role="tabcard" aria-labelledby="headingOne">
        <div class="card-body">
            @if($attribute->field_type == "SELECT")
                @foreach($attribute->attributeDropdownOptions as $dropdownValue)
                    <div class="col-md-12 single-option-box"
                         style="border: 1px solid #ccc; padding: 10px;margin-bottom: 10px">
                        <button type="button" class="close close-variation">&times;</button>
                        <label>{{ $dropdownValue->display_text }}</label>
                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <input type="hidden"
                                   name="variations[{{ $attribute->id }}][dropdown][{{ $dropdownValue->id }}][title]"
                                   value="{{$dropdownValue->display_text}}">
                            <div class="col-md-3 form-group">
                                <label>Image</label>
                                <input type="file"
                                       name="variations[{{ $attribute->id }}][dropdown][{{ $dropdownValue->id }}][image]"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>SKU</label>
                                <input type="text" name="variations[{{ $attribute->id }}][dropdown][{{ $dropdownValue->id }}][sku]"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <label>Qty</label>
                                <input type="text" name="variations[{{ $attribute->id }}][dropdown][{{ $dropdownValue->id }}][qty]"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <label>Price</label>
                                <input type="text"
                                       name="variations[{{ $attribute->id }}][dropdown][{{ $dropdownValue->id }}][price]"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <hr/>
                @endforeach

            @endif


            @if($attribute->field_type == "TEXT")

                <p>{{ $attribute->title }} will appear on Product Page as a Text Field.</p>
                <input name="variations[{{ $attribute->id }}][text][attribute_id]" type="hidden" value="{{ $attribute->id }}">
            @endif

        </div>
    </div>
</div>