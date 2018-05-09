
@include('avored-ecommerce::forms.text',['name' => 'name' ,'label' => 'Category Name'])
@include('avored-ecommerce::forms.text',['name' => 'slug' ,'label' => 'Category Slug'])
@include('avored-ecommerce::forms.select',['name' => 'parent_id' ,'label' => 'Parent Category', 'options' => $categoryOptions])


@push('scripts')
<script>

    $(function() {

        var field1Selector = "#name";
        var field2Selector = "#slug";

        var buttonSelector = ".category-save-button";

        function checkFields() {
            var field1Value = jQuery(field1Selector).val();
            var field2Value= jQuery(field2Selector).val();


            if(field1Value != "" && field2Value  != "") {
                jQuery(buttonSelector).attr('disabled', false);
                jQuery(buttonSelector).addClass('btn-primary');
            } else {
                jQuery(buttonSelector).attr('disabled', true);
                jQuery(buttonSelector).removeClass('btn-primary');
            }
        }
        jQuery(document).on('keyup', '#name , #slug', function(e){
            checkFields();
        });

        jQuery(document).on('change', '#name, #slug', function(e){
            checkFields();
        });
        checkFields();
    });
</script>
@endpush