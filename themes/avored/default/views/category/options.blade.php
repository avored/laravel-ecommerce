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
        @foreach($category->categoryFilter as $filter)



            @if(array_get($filter,'type') === "ATTRIBUTE")
                @php
                    $attribute = $filter->model;
                @endphp


                <h4>{{ $attribute->name }}</h4>
                <ul class="list-group">

                    @foreach($attribute->attributeDropdownOptions as $option)

                        @php

                            $attributeParams = isset($params['attribute']) ? $params['attribute'] : [];
                            $queryParams = $params;

                            $checkedQueryParams = ["attribute[" .$attribute->identifier . "]" => $option->id] + $queryParams; 
                            $checkedQueryParams['slug'] = $category->slug;
                            
                            $uncheckedParams['slug'] = $category->slug;
                            if(isset($queryParams['attribute'][$attribute->identifier])) {
                                unset($queryParams['attribute'][$attribute->identifier]);
                            } else {
                                $uncheckedParams = ["attribute[" .$attribute->identifier . "]" => $option->id] + $queryParams;
                            }
                             

                        @endphp
                        <li class="list-group-item">

                            <input id="variation-{{ $option->id }}"
                                   type="checkbox"

                                   class="category-variation-checkbox"

                                   @if(in_array($attribute->identifier, array_keys($attributeParams)) &&
                                        in_array($option->id, array_values($attributeParams)))
                                   {{ "checked" }}

                                   data-checked-url="{{ route('category.view',$checkedQueryParams) }}"
                                   data-unchecked-url="{{ route('category.view', $uncheckedParams) }}"

                                   @else

                                   data-checked-url="{{ route('category.view',$checkedQueryParams) }}"
                                   data-unchecked-url="{{ route('category.view', $uncheckedParams) }}"


                                   @endif
                                   name="attribute[{{ $attribute->identifier }}]" value="{{ $option->id }}">
                            <label for="variation-{{ $option->id }}">
                                {{ $option->display_text }}
                            </label>
                        </li>
                    @endforeach

                </ul>

            @endif

            @if(array_get($filter,'type') === "PROPERTY")
                @php
                    $attribute = $filter->model;
                @endphp
               

                <h4>{{ $attribute->name }}</h4>
                <ul class="list-group">

                    @foreach($attribute->propertyDropdownOptions as $option)

                        @php

                            $attributeParams = isset($params['property']) ? $params['property'] :  [];
                            $queryParams = $params;
                            $checked = "";

                            if(in_array($attribute->identifier, array_keys($attributeParams)) &&
                                        in_array($option->id, array_values($attributeParams))) {

                                $checked = "checked";
                                $checkedQueryParams['property'][$attribute->identifier] = $option->id;
                                $checkedQueryParams = $checkedQueryParams + $queryParams; 
                                
                                $checkedQueryParams['slug'] = $category->slug;

                                if ($queryParams['property'][$attribute->identifier] == $option->id) {
                                    unset($queryParams['property'][$attribute->identifier]);
                                    if(count($queryParams['property']) <= 0) {
                                        unset($queryParams['property']);
                                    }

                                }
                                $uncheckedParams = ['slug' => $category->slug] + $queryParams;
                                
                                             
                            } else {

                                
                                $checkedQueryParams['property'][$attribute->identifier] = $option->id;
                                $checkedQueryParams = $checkedQueryParams + $queryParams; 
                                
                                $checkedQueryParams['slug'] = $category->slug;
                                $uncheckedParams = $checkedQueryParams;
                                                
                            }
                            


                        @endphp
                        <li class="list-group-item">
                            <input id="variation-{{ $option->id }}"
                                   type="checkbox"

                                   class="category-variation-checkbox"

                        
                                   {{ $checked }}
                                   
                                   data-checked-url="{{ route('category.view',$checkedQueryParams) }}"
                                   data-unchecked-url="{{ route('category.view', $uncheckedParams) }}"

                                  

                                   name="property[{{ $attribute->identifier }}]" value="{{ $option->id }}">
                            <label for="variation-{{ $option->id }}">
                                {{ $option->display_text }}
                            </label>
                        </li>
                    @endforeach

                </ul>

            @endif
        @endforeach

    </div>
</div>

@push('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery(document).on('change', '.category-variation-checkbox', function (e) {
                e.preventDefault();
                if (jQuery(this).is(":checked")) {
                    location = jQuery(this).attr('data-checked-url');
                } else {
                    location = jQuery(this).attr('data-unchecked-url');
                }

            })

        });

    </script>
@endpush