
jQuery(document).ready(function () {
    jQuery('select').material_select();
    jQuery('.datepicker').pickadate({});
    jQuery("div.dropzone").dropzone({ url: "/admin/product-upload",uploadMultiple : false, addRemoveLinks: true });


});