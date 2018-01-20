

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

@endforeach