 
<div class="panel panel-default">
    <div class="panel-heading">
        <span>{{ $group->title }} </span>
    </div>
    
    
    <div class="panel-body">
        
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
        @endif

        <!--
        
                            
        -->
    </div>

</div>
<script>

    jQuery(document).ready(function () {
     
    })
</script>