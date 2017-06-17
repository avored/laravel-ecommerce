<?php

//dd($dataGrid->model);
?>
<table class="table-grid table table-striped table-responsive ">
    <tr>
        @foreach($dataGrid->columns as $column)
            <?php
            //dd($column->getLabel());
            ?>
            <th>
                {{ $column->getLabel() }}
            </th>
        @endforeach
    </tr>

    @foreach($dataGrid->data as $row)
        <tr>
            @foreach($dataGrid->columns as $column)
                <td>
                    @if($column->getDataType() == "link")
                        {!! $column->executeCallback($row) !!}
                    @else
                        <?php $identifier = $column->getIdentifier() ?>
                        {{ $row->$identifier }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>

{!! $dataGrid->data->links() !!}