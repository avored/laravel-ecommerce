{!! Form::text('title','Title') !!}

{!! Form::select('product_attribute_group_id','Product Attribute Group' , $productAttributeGroupOptions) !!}
{!! Form::text('identifier','Identifier') !!}
{!! Form::select('field_type','Field Type',['' => 'Please Select','TEXT' => 'Text','TEXTAREA' => 'Text Area','SELECT' => 'Dropdown'] ) !!}
{!! Form::select('type','Data Type',['' => 'Please Select','VARCHAR' => 'Varchar','FLOAT' => 'Float','TEXT' => 'Text Area'] ) !!}

@if(!isset($attribute->validation))
    <?php $validations = []; ?>
@else
    <?php $validations = explode("|" , $attribute->validation); ?>
@endif

{!! Form::select('validation[]','Validation',['required' => 'Required','max:255' => 'Max Length 255'],['class' => 'select2 form-control','multiple' => true, 'value' => $validations] ) !!}


{!! Form::text('sort_order','Sort Order') !!}