@foreach($productAttributes as $productAttribute)

    @if($productAttribute->field_type == "TEXT")
        @include('template.text',['key' => $productAttribute->identifier,'label' => $productAttribute->title])
    @endif


    @if($productAttribute->field_type == "SELECT")
        @include('template.select',['key' => $productAttribute->identifier,
                                    'label' => $productAttribute->title,
                                    'options' => $productAttribute->attributeDropdownOptions()->lists('label','value')
                                    ])
    @endif
    
     @if($productAttribute->field_type == "DATETIME")
        @include('template.datetime',['key' => $productAttribute->identifier,
                                    'label' => $productAttribute->title
                                    ])
    @endif
    
    @if($productAttribute->field_type == "TEXTAREA")
        @include('template.textarea',['key' => $productAttribute->identifier,
                                    'label' => $productAttribute->title
                                    ])
    @endif

    @if($productAttribute->type == "FILE" && $productAttribute->identifier == "image")
        @include('template.product-image',['key' => $productAttribute->identifier,'label' => $productAttribute->title])
    @elseif($productAttribute->type == "FILE")
        @include('template.file',['key' => $productAttribute->identifier,'label' => $productAttribute->title])
    @endif

@endforeach

@include('product.fields.category',['key' => 'category_id[]',
                                                   'label' => 'Category',
                                                   'options' => $categories
                                           ])

@include('template.select2',['key' => 'website_id[]',
                                   'label' => 'Website',
                                   'options' => $websites
                           ])