@foreach ($categoryFilters as $categoryFilter)        
    <a-card class="mt-1" title="{{ $categoryFilter->filter->name }}"> 
        
        @if($categoryFilter->type == 'PROPERTY' && $categoryFilter->filter->use_for_category_filter)
            @if (
                $categoryFilter->filter->field_type === "SELECT" &&
                $categoryFilter->filter->dropdown !== null &&
                $categoryFilter->filter->dropdown->count() > 0
            )
                @foreach ($categoryFilter->filter->dropdown as $dropdownOption)
                <p>
                     
                    <a-checkbox
                        @if(request()->get('p___' . $categoryFilter->filter->slug) !== null &&
                            in_array($dropdownOption->id, request()->get('p___' . $categoryFilter->filter->slug))
                        )
                            default-checked
                        @endif
                        @change="filterCheckboxChange(
                            $event,
                            '{{ $categoryFilter->filter->slug }}',
                            '{{ $dropdownOption->id }}',
                            '{{ $categoryFilter->type }}')">
                        {{ $dropdownOption->display_text }}
                    </a-checkbox>
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
                     
                    <a-checkbox
                        @if(request()->get('a___' . $categoryFilter->filter->slug) !== null &&
                            in_array($dropdownOption->id, request()->get('a___' . $categoryFilter->filter->slug))
                        )
                            default-checked
                        @endif
                        @change="filterCheckboxChange(
                            $event,
                            '{{ $categoryFilter->filter->slug }}',
                            '{{ $dropdownOption->id }}',
                            'ATTRIBUTE')">
                        {{ $dropdownOption->display_text }}
                    </a-checkbox>
                </p>
                @endforeach
            @endif
        @endif
    </a-card>
@endforeach
