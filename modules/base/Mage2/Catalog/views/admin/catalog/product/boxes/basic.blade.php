 
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <span>Basic Info</span>
        </div>
        {!! Form::text('title','Title') !!}
        {!! Form::text('slug','Slug') !!}
        {!! Form::text('sku','SKU') !!}
        
        {!! Form::textarea('description','Description',['class' => 'ckeditor']) !!}
        
        {!! Form::text('price','Price') !!}
       
        {!! Form::select('status','Status',$statusOptions) !!}

        <!--
        textarea class="" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea
        
        include('template.editor',['key' => '','label' => '','attributes' => ['class' => 'bootstrap-wysywig materialize-textarea']])
        -->
        
        @if(!isset($productCategories)) 
            <?php $productCategories = []; ?>
        @endif
        @if(!isset($productWebsites)) 
            <?php $productWebsites = []; ?>
        @endif

        {!! Form::select("category_id[]", "Category", $categories,
                            ['class' => 'form-control select2',
                            'multiple' => 'true',
                            'value' => $productCategories
                            ]
                        ) !!}
        {!! Form::select("website_id[]", "Website", $websites,
                            [   'class' => 'form-control select2',
                                'multiple' => 'true',
                                'value' => $productWebsites
                            ]) !!}

        
    </div>

</div>
<script>

    jQuery(document).ready(function () {
     
    })
</script>