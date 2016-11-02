 
<div class="panel panel-default">
    <div class="panel-heading">
        <span>Inventory</span>
        <!--div class="box-tools right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div-->
    </div>
    <div class="panel-body">
        {!! Form::select('in_stock','In Stock',$inStockOptions) !!}
        {!! Form::select('track_stock','Track Stock',$trackStockOptions) !!}
        
        {!! Form::text('qty','Quantity') !!}
        
        {!! Form::select('is_taxable','Is Taxable',$isTaxableOptions) !!}
        
         
       
    </div>
    
</div>
 