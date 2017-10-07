
@include('mage2-ecommerce::forms.text',['name' => 'name' , 'label' => 'Name'])

<?php $values = []; ?>
@if(isset($model))
    <?php
    $values = $model->taxRules->pluck('id')->toArray();
    ?>
@endif


@include('mage2-ecommerce::forms.select',['name' => 'tax_rules[]' , 'label' => 'Tax Rule', 'options' => $taxRulesOptions])
