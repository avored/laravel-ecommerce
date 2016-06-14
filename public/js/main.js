
jQuery(document).ready(function () {
    jQuery('select').material_select();
    jQuery('.datepicker').pickadate({
            format:"dd-mmmm-yyyy",
            formatSubmit: 'yyyy/mm/dd',
            hiddenSuffix: ''
        });


    Dropzone.options.myAwesomeDropzone = {
        url: "/admin/product-upload",
        addRemoveLinks: true,
        removedfile: function (file) {

        },
        init: function () {

            this.on("success", function (file,response) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                    var hiddenElement = document.createElement('input');
                    hiddenElement.type = "hidden";
                    hiddenElement.name= "images[]";
                    hiddenElement.value = response.id;

                    document.getElementById('image_hidden_element').appendChild(hiddenElement);


                }
            });
        }
    };


});