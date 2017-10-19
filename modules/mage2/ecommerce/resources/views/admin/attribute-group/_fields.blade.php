
@include('mage2-ecommerce::forms.text',['name' => 'name' , 'label' => 'Name'])

<?php $values = []; ?>
@if(isset($model))
    <?php
    $values = $model->attributes->pluck('id')->toArray();
    ?>
@endif


@include('mage2-ecommerce::forms.select2',['name' => 'attributes[]' ,
                                            'attributes' => ['class' => 'select2 form-control','multiple' => true],
                                            'label' => 'Attributes',
                                            'options' => $attributesOptions,
                                            'values' => $values])

@push('scripts')
    <script>
        $(function() {
            jQuery('.select2').select2();
        })
    </script>
@endpush
