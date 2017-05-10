<div class="panel">
    <div class="panel-body">
        <h6>Filter By Product Attributes</h6>
        <hr/>


        @if(($category->children->count()) > 0)
            <h4>Sub Categories</h4>
            <ul class="list-group">
                @foreach($category->children as $subCategory)
                    <li class="list-group-item">
                        <a href="{{ route('category.view', $subCategory->slug) }}">{{ $subCategory->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <?php
        $attributes = $category->getFilters();
        ?>
        @foreach($attributes as $attribute)

            <?php
            //dd($attribute->attributeDropdownOptions);
            ?>
            <h4>{{ $attribute->title }}</h4>
            <ul class="list-group">
                @foreach($attribute->attributeDropdownOptions as $option)
                    <li class="list-group-item">
                        <input id="variation-{{ $option->id }}"
                               type="checkbox"
                               data-url="{{ route('category.view',['slug' => $category->slug,$attribute->identifier => $option->id]) }}"
                               class="category-variation-checkbox"
                               name="{{ $attribute->identifier }}" value="{{ $option->id }}">
                        <label for="variation-{{ $option->id }}">
                            {{ $option->display_text }}
                        </label>
                    </li>
                @endforeach

            </ul>
        @endforeach

    </div>
</div>

@push('scripts')
<script>
    jQuery(document).ready(function() {
        jQuery(document).on('change', '.category-variation-checkbox',function(e) {
            e.preventDefault();
            location = jQuery(this).attr('data-url');
        })

    });

</script>
@endpush