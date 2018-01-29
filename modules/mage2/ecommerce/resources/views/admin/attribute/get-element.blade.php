<div class="col-md-6 mb-3 single-card">

    <button type="button" class="remove-variation-card">
        <span aria-hidden="true">&times;</span>
    </button>

    <div class="card clearfix pt-2">
        <div class="card-body">



                @foreach($attributes as $attribute)

                    @if($attribute->field_type == 'TEXT')
                        <div class="form-group">
                            <label for="attribute-{{ $tmpString }}-{{ $attribute->id }}">{{ $attribute->name }}</label>
                            <input type="text"
                                   name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]"
                                   class="form-control"
                                   id=attribute-{{ $tmpString }}-{{ $attribute->id }}"
                            />
                        </div>
                    @endif

                    @if($attribute->field_type == 'CHECKBOX')
                        <div class="form-check">

                            <input type="hidden"
                                   name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]"
                                   value="0"
                            />

                            <input type="checkbox"
                                   name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]"
                                   class="form-check-input"
                                   value="1"
                                   id=attribute-{{ $tmpString }}-{{ $attribute->id }}"
                            />
                            <label class="form-check-label"
                                   for="attribute-{{ $tmpString }}-{{ $attribute->id }}">
                                {{ $attribute->name }}
                            </label>
                        </div>
                    @endif

                    @if($attribute->field_type == 'TEXTAREA')
                        <div class="form-group">
                            <label for="attribute-{{ $tmpString }}-{{ $attribute->id }}">{{ $attribute->name }}</label>

                            <textarea name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]" class="form-control"
                                      id=attribute-{{ $tmpString }}-{{ $attribute->id }}"></textarea>

                        </div>
                    @endif

                    @if($attribute->field_type == 'SELECT')
                        <div class="form-group">
                            <label for="attribute-{{ $tmpString }}-{{ $attribute->id }}">{{ $attribute->name }}</label>

                            <select name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]" class="form-control"
                                    id=attribute-{{ $tmpString }}-{{ $attribute->id }}">

                                @foreach($attribute->attributeDropdownOptions as $option)
                                    <option value="{{ $option->id }}">{{ $option->display_text }}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif

                    @if($attribute->field_type == 'DATETIME')
                        <div class="form-group">
                            <label for="attribute-{{ $tmpString }}-{{ $attribute->id }}">{{ $attribute->name }}</label>
                            <input type="text"
                                   name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][value]"
                                   class="form-control datetime"
                                   id=attribute-{{ $tmpString }}-{{ $attribute->id }}"
                            />
                        </div>

                    @endif

                @endforeach



                <div class="form-group">
                    <label for="attribute-{{ $tmpString }}-price">Price Variation</label>
                    <input type="text"
                           name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][price]"
                           class="form-control"
                           id=attribute-{{ $tmpString }}-price"
                    />
                </div>

                <div class="form-group">
                    <label for="attribute-{{ $tmpString }}-qty">Qty</label>
                    <input type="text"
                           name="attribute[{{ $tmpString }}][{{ $attribute->id  }}][qty]"
                           class="form-control"
                           id=attribute-{{ $tmpString }}-qty"
                    />
                </div>





        </div>
    </div>
</div>