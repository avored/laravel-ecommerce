<div class="row">
    <div class="col-6">
        @include('mage2-ecommerce::forms.text',['name' => 'name','label' => 'Name'])
    </div>
    <div class="col-6">
        @if(!isset($productCategories))
            <?php $productCategories = []; ?>
        @endif

            @include('mage2-ecommerce::forms.text',['name' => 'category_id[]',
                                                    'label' => 'Category',
                                                    'attributes' => ['class' => 'form-control select2',
                                                                    'id' => 'category_id',
                                                                    'multiple' => true,

                                                                    ],
                                                    'options' => $categoryOptions])



    </div>
</div>


<div class="row">
    <div class="col-6">
        @if(isset($editMethod) && $editMethod)
            @include('mage2-ecommerce::forms.text',['name' => 'slug','label' => 'Slug'])
        @endif
    </div>
    <div class="col-6">
        @include('mage2-ecommerce::forms.text',['name' => 'sku','label' => 'Sku'])
    </div>
</div>

{!! Form::textarea('description', 'Description',['class' => 'ckeditor']) !!}

<div class="row">
    @if($product->type == "VARIATION")
    <div class="col-6">
        {!! Form::text('price', 'Base Price') !!}
    </div>
    @else
        <div class="col-6">
            {!! Form::text('price', 'Price') !!}
        </div>
    @endif
    <div class="col-6">
        {!! Form::select('status', 'Status',['1' => 'Enabled','0' => 'Disabled']) !!}
    </div>
</div>


<div class="row">
    <div class="col-6">
        {!! Form::text('qty', 'Qty') !!}
    </div>
    <div class="col-6">
        {!! Form::select('in_stock', 'In Stock',['1' => 'Enabled','0' => 'Disabled']) !!}
    </div>
</div>

<div class="row">
    <div class="col-6">
        {!! Form::select('track_stock', 'Track Stock',['1' => 'Enabled','0' => 'Disabled']) !!}
    </div>
    <div class="col-6">
        {!! Form::select('is_taxable', 'Is Taxable',['1' => 'Enabled','0' => 'Disabled']) !!}
    </div>
</div>







@foreach(Attributes::all('basic-product') as $attribute)
    <?php

    ?>
    {!! $attribute->render() !!}
    <?php

    /**
    dd();
    $field = $attribute->get('field');
    $fieldAttrString = "";
    foreach ($field['attributes'] as $attrKey => $attrVal) {
    $fieldAttrString .= $attrKey . "=" . "$attrVal ";
    }

    ($field['type'] == "select")


    $fieldOptionString = "";
    foreach ($field['options'] as $optionKey => $optionVal) {
    $fieldOptionString .=  "<option value=" . $optionKey . ">" . "$optionVal " . "</option> ";
    }


    <div class="form-group">
    <label for=""> $field['label'] }}</label>
    <select  $fieldAttrString }}>
    !$fieldOptionString  !!}
    </select>
    </div>
     */

    ?>


@endforeach


@push('scripts')
<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush