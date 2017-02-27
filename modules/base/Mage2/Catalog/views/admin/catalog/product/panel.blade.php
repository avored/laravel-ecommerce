<div class="panel panel-default">
    <div class="panel-heading">
        <span>{{ $group->title }} </span>
    </div>


    <div class="panel-body">


        @if($group->identifier == "basic")
        {!! Form::text('title', 'Title') !!}
        {!! Form::text('slug', 'Slug') !!}
        {!! Form::text('sku', 'SKU') !!}
        {!! Form::textarea('description', 'Description',['class' => 'ckeditor']) !!}
        {!! Form::select('status', 'Stats',['0' => 'Enabled','1' => 'Disabled']) !!}
        @endif

        @if($group->identifier == "inventory")
        {!! Form::select('in_stock', 'In Stock',['0' => 'Enabled','1' => 'Disabled']) !!}

        {!! Form::select('track_stock', 'Track Stock',['0' => 'Enabled','1' => 'Disabled']) !!}
        {!! Form::text('qty', 'Qty') !!}
        {!! Form::select('is_taxable', 'In Stock',['0' => 'Enabled','1' => 'Disabled']) !!}


        @endif

        @if($group->identifier == "seo")
        {!! Form::text('page_title', 'Page Title') !!}
        {!! Form::textarea('page_description', 'Page Description') !!}


        @endif
        @foreach($group->productAttributes()->orderBy('sort_order')->get() as $attribute)


        @if($attribute->field_type == "TEXT")
        {!! Form::text($attribute->identifier, $attribute->title) !!}
        @endif

        @if($attribute->field_type == "TEXTAREA")
        {!! Form::textarea($attribute->identifier, $attribute->title) !!}
        @endif

        @if($attribute->field_type == "CKEDITOR")
        {!! Form::textarea($attribute->identifier, $attribute->title,['class' => 'ckeditor']) !!}
        @endif

        @if($attribute->field_type == "SELECT")

        {!! Form::select($attribute->identifier,$attribute->title,$attribute->getDropdownOptions()) !!}
        @endif


        @endforeach

        @if($group->identifier == "basic")

        @if(!isset($productCategories))
        <?php $productCategories = []; ?>
        @endif

        {!! Form::select("category_id[]", "Category", $categories,
                        ['class' => 'form-control select2',
                        'multiple' => 'true',
                        'value' => $productCategories
                        ]
                    ) !!}

        @endif

                <!--
        
                            
        -->
    </div>

</div>
<script>

    jQuery(document).ready(function () {

    })
</script>