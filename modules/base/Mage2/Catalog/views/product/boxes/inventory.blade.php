 
<div class="card card-default">
    <div class="card-content">
    <div class="card-title">
        <span>Inventory</span>
        <!--div class="box-tools right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div-->
    </div>

        @include('template.select',['key' => 'in_stock','label' => 'In Stock','options' => $inStockOptions])
        @include('template.select',['key' => 'track_stock','label' => 'Track Stock','options' =>$trackStockOptions])
        @include('template.text',['key' => 'qty','label' => 'Quantity'])

        @include('template.select',['key' => 'is_taxable','label' => 'Is Taxable', 'options' => $isTaxableOptions])
         
       
    </div>
    
</div>
 