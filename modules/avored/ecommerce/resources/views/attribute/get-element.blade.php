<div class="col-md-12">

    @foreach($attributes as $attribute)
        <div class="border-dark border option-tag-list  p-2 mt-3 ">
            @foreach($attribute->attributeDropdownOptions as $option)

                    <span class="tag single-option badge badge-primary">

                        <span>{{ $option->display_text }}</span>

                        <a><i class="remove remove-option ">&times;</i></a>
                        <input type="hidden" name="attribute[{{ $attribute->id }}][]" value="{{ $option->id }}">
                </span>

            @endforeach
        </div>
    @endforeach

</div>