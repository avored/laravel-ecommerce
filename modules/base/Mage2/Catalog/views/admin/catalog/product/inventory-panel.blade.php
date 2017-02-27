<div class="panel panel-default">
    <div class="panel-heading">
        <span>Inventory</span>
    </div>


    <div class="panel-body">
{!! Form::select('in_stock', 'In Stock',['0' => 'Enabled','1' => 'Disabled']) !!}

{!! Form::select('track_stock', 'Track Stock',['0' => 'Enabled','1' => 'Disabled']) !!}
{!! Form::text('qty', 'Qty') !!}
{!! Form::select('is_taxable', 'In Stock',['0' => 'Enabled','1' => 'Disabled']) !!}

    </div>

</div>

