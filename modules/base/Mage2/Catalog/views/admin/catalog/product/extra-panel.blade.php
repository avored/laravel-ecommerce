<div class="panel panel-default">
    <div class="panel-heading">
        <span>EXTRA Attributes </span>
    </div>


    <div class="panel-body">
        @foreach($extraAttributes as $attribute)


            @if($attribute->field_type == "SELECT")
                {!! Form::select($attribute->identifier, $attribute->title, $attribute->attributeDropdownOptions->pluck('display_text','id')) !!}
            @endif


        @endforeach

    </div>

</div>

