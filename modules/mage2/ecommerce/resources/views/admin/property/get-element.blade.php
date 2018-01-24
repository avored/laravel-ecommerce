

@foreach($properties as $property)

    @if($property->field_type == 'TEXT')
        <div class="form-group">
            <label for="property-{{ $tmpString }}-{{ $property->id }}">{{ $property->name }}</label>
            <input type="text"
                    name="property[{{ $tmpString }}][{{ $property->id  }}]"
                    class="form-control"
                    id=property-{{ $tmpString }}-{{ $property->id }}"
            />
        </div>
    @endif


    @if($property->field_type == 'CHECKBOX')
        <div class="form-check">

            <input type="hidden"
                   name="property[{{ $tmpString }}][{{ $property->id  }}]"
                   value="0"
            />

            <input type="checkbox"
                   name="property[{{ $tmpString }}][{{ $property->id  }}]"
                   class="form-check-input"
                   value="1"
                   id=property-{{ $tmpString }}-{{ $property->id }}"
            />
            <label class="form-check-label"
                    for="property-{{ $tmpString }}-{{ $property->id }}">
                {{ $property->name }}
            </label>
        </div>
    @endif

    @if($property->field_type == 'TEXTAREA')
        <div class="form-group">
            <label for="property-{{ $tmpString }}-{{ $property->id }}">{{ $property->name }}</label>

            <textarea name="property[{{ $tmpString }}][{{ $property->id  }}]" class="form-control"
                      id=property-{{ $tmpString }}-{{ $property->id }}"></textarea>

        </div>
    @endif

    @if($property->field_type == 'SELECT')
        <div class="form-group">
            <label for="property-{{ $tmpString }}-{{ $property->id }}">{{ $property->name }}</label>

            <select name="property[{{ $tmpString }}][{{ $property->id  }}]" class="form-control"
                    id=property-{{ $tmpString }}-{{ $property->id }}">

                @foreach($property->propertyDropdownOptions as $option)
                    <option value="{{ $option->id }}">{{ $option->display_text }}</option>
                @endforeach
            </select>

        </div>
    @endif


    @if($property->field_type == 'DATETIME')
        <div class="form-group">
            <label for="property-{{ $tmpString }}-{{ $property->id }}">{{ $property->name }}</label>
            <input type="text"
                   name="property[{{ $tmpString }}][{{ $property->id  }}]"
                   class="form-control datetime"
                   id=property-{{ $tmpString }}-{{ $property->id }}"
            />
        </div>

    @endif




@endforeach