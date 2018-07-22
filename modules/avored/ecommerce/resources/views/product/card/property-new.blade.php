<div class="row">

    <div class="col-12">

        <div id="add-property" class="input-group">

            <select name="product-property[]"
                    multiple="true"
                    class="select2 form-control modal-product-property-select"
                    style="width: 88%">
                @foreach($propertyOptions as $propertyOption)
                    <option
                            @if($productProperties->contains('property_id',$propertyOption->id))
                                selected
                            @endif

                            value="{{ $propertyOption->id }}">
                        {{ $propertyOption->name }}
                    </option>
                @endforeach
            </select>


            <div class="input-group-append">
                <button type="button"
                        data-token="{{ csrf_token() }}"
                        class="btn btn-warning modal-use-selected">
                    Use Selected
                </button>
            </div>

        </div>
        <hr/>
        <div class="property-content-wrapper">

        CONTENT GOES HERE 
        </div>
    </div>
</div>
    