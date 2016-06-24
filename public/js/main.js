
jQuery(document).ready(function () {
    jQuery('select').material_select();
    jQuery('.datepicker').pickadate({
        format: "dd-mmmm-yyyy",
        formatSubmit: 'yyyy/mm/dd',
        hiddenSuffix: ''
    });



});