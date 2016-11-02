 
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel-heading">
            <span>Basic Info</span>
            <!--div class="panel panel-default-tools right">
                <button class="btn btn-panel panel-default-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div-->
        </div>
        {!! Form::text('title','Title') !!}
        {!! Form::text('slug','Slug') !!}
        {!! Form::text('sku','SKU') !!}
        
        {!! Form::textarea('description','Description') !!}
        
        {!! Form::text('price','Price') !!}
        
        {!! Form::select('status','Status',$statusOptions) !!}
        {!! Form::select('is_featured','Is Featured',$isFeaturedOptions) !!}



        <!--
        textarea class="" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea
        
        include('template.editor',['key' => '','label' => '','attributes' => ['class' => 'bootstrap-wysywig materialize-textarea']])
        -->



        {!! Form::select("category_id[]", "Category", $categories) !!}
        {!! Form::select("website_id[]", "Website", $websites) !!}
        
    </div>

</div>
<script>

    jQuery(document).ready(function () {
     
    })
</script>