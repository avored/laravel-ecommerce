
@include('mage2-ecommerce::forms.text',['name' => 'name' , 'label' => 'Name'])

<?php $values = []; ?>
@if(isset($model))
    <?php
    $values = $model->taxRules->pluck('id')->toArray();
    ?>
@endif


@include('mage2-ecommerce::forms.select',['name' => 'tax_rules[]' ,
                                            'attributes' => ['class' => 'select2 form-control','multiple' => true],
                                            'label' => 'Tax Rule',
                                            'options' => $taxRulesOptions])

@push('scripts')
    <script>
        $(function() {
            jQuery('.select2').select2();
        })
    </script>
@endpush
