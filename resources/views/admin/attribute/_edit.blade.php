<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group">
            {!!  Form::label('name', 'Name')  !!}
            {!!  Form::text('name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
        </div>

        <div class="form-group">
            {!!  Form::label('unique_key', 'Key')  !!}
            {!!  Form::text('unique_key',null,array('class'=>'form-control'))  !!}
        </div>


        <div class="form-group">
            {!!  Form::label('entity_id', 'Entity')  !!}
            {!!  Form::select('entity_id', $entities , null , array('class'=>'form-control'))  !!}
        </div>

        <div class="form-group">
            {!!  Form::label('type', 'Type')  !!}
            {!!  Form::select('type', $types , null ,array('class'=>'form-control attribute_type'))  !!}
        </div>
        @include('mage2::admin._display_errors')
    </div>
</div>
<?php $class = (isset($attribute) && $attribute->AttributeSelectValue()->count()>0) ? "" : 'hide'; ?>
<div class="panel panel-default attribute_select_option {{ $class }}">

    <div class="panel-body">
        <div class="container-fluid">


            <?php if($class != "hide"): ?>

            <div class="attribute_key_value_row">
                <?php foreach($attribute->AttributeSelectValue()->get() as $attributeSelectValue): ?>

                <div class="row">
                    <div class="col-md-4 key">
                            <label>Key</label>
                            <input type="text" name="select[{{ $attributeSelectValue->id }}][unique_key]"
                                   value="{{ $attributeSelectValue->unique_key }}"
                                   class="form-control" placeholder="Key..">
                    </div>
                    <div class="col-md-4 value">
                        <label>Value</label>
                        <input type="text" name="select[{{ $attributeSelectValue->id }}][value]" 
                               value="{{ $attributeSelectValue->value }}"
                               class="form-control" placeholder="Value">
                    </div>
                    <div class="col-md-4 delete">
                        <label>&nbsp;</label>
                        <a href="" class="btn btn-danger form-control">Delete</a>
                    </div>
                </div>
                <?php  endforeach; ?>
            </div>
            <br/>
            <div class="add-button">
                <button type="Add" class="btn btn-primary add_custom_button">Add </button>
            </div>
            <?php else: ?>
           
            <div class="attribute_key_value_row"></div>
             <br/>
            <div class="add-button">
                <button type="Add" class="btn btn-primary add_custom_button">Add </button>
            </div>
            <?php  endif; ?>
        </div>

    </div>

</div>


<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()',
    'class' => 'btn btn-primary' ))  !!}
</div>