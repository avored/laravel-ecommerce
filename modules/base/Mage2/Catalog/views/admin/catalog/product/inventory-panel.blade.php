<div class="panel panel-default">
    <div class="panel-heading">
        <span>Inventory</span>
    </div>


    <div class="panel-body">
{!! Form::select('in_stock', 'In Stock',['1' => 'Enabled','0' => 'Disabled']) !!}

{!! Form::select('track_stock', 'Track Stock',['1' => 'Enabled','0' => 'Disabled']) !!}
{!! Form::text('qty', 'Qty') !!}
{!! Form::select('is_taxable', 'In Stock',['1' => 'Enabled','0' => 'Disabled']) !!}

    </div>

</div>

