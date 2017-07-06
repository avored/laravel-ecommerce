<div class="panel panel-default">
    <div class="panel-heading">
        <span>Basic</span>
    </div>

    <div class="panel-body">

        {!! Form::text('title', 'Title') !!}
        {!! Form::text('slug', 'Slug') !!}
        {!! Form::text('sku', 'SKU') !!}
        {!! Form::textarea('description', 'Description',['class' => 'ckeditor']) !!}

        {!! Form::text('price', 'Price') !!}

        {!! Form::select('status', 'Stats',['1' => 'Enabled','0' => 'Disabled']) !!}

        @if(!isset($productCategories))
            <?php $productCategories = []; ?>
        @endif

        {!! Form::select("category_id[]", "Category", $categories,
                        ['class' => 'form-control select2',
                        'multiple' => 'true',
                        'value' => $productCategories
                        ]
                    ) !!}


    </div>

</div>
@push('scripts')
<script>
    jQuery(document).ready(function() {

        jQuery(document).on('keydown','#title',function(e){
                var productName = jQuery(this).val();
                jQuery('.top-header .product-name').html(productName)
        });


    });
</script>

@endpush

