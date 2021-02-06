
@foreach ($categoryFilters as $categoryFilter)        
    <div class="mb-5 rounded border">
        <div class="border-b p-5">
            {{ $categoryFilter->filter->name }}
        </div>
        
        <div class="p-5">
            @if($categoryFilter->type == 'PROPERTY' && $categoryFilter->filter->use_for_category_filter)
                @if (
                    $categoryFilter->filter->field_type === "SELECT" &&
                    $categoryFilter->filter->dropdown !== null &&
                    $categoryFilter->filter->dropdown->count() > 0
                )
                    @foreach ($categoryFilter->filter->dropdown as $dropdownOption)
                    <p>
                        
                        <input type="checkbox"
                            @if(request()->get('p___' . $categoryFilter->filter->slug) !== null &&
                                in_array($dropdownOption->id, request()->get('p___' . $categoryFilter->filter->slug))
                            )
                                checked
                            @endif
                            @change="filterCheckboxChange(
                                $event,
                                '{{ $categoryFilter->filter->slug }}',
                                '{{ $dropdownOption->id }}',
                                '{{ $categoryFilter->type }}')" 
                        />
                        {{ $dropdownOption->display_text }}
                       
                    </p>
                    @endforeach
                @endif
            @endif
            @if($categoryFilter->type == 'ATTRIBUTE')
            
                @if (
                    $categoryFilter->filter->dropdown !== null &&
                    $categoryFilter->filter->dropdown->count() > 0
                )
                    @foreach ($categoryFilter->filter->dropdown as $dropdownOption)
                    <p>
                        
                        <input type="checkbox"
                            @if(
                                request()->get('a___' . $categoryFilter->filter->slug) !== null &&
                                in_array($dropdownOption->id, request()->get('a___' . $categoryFilter->filter->slug))
                            )
                                checked
                            @endif
                            @change="filterCheckboxChange(
                                $event,
                                '{{ $categoryFilter->filter->slug }}',
                                '{{ $dropdownOption->id }}',
                                'ATTRIBUTE')" 
                        > 
                            {{ $dropdownOption->display_text }}
                        
                    </p>
                    @endforeach
                @endif
            @endif
        </div>

    </div>
@endforeach
