
jQuery(document).ready(function () {
    jQuery('select').material_select();
    jQuery('.datepicker').pickadate({});


    Dropzone.options.myAwesomeDropzone = {
        url: "/admin/product-upload",
        addRemoveLinks: true,
        removedfile: function (file) {

        },
        init: function () {

            this.on("success", function (file,response) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                    complete = file;
                    console.info(response);
                    alert('complete')
                }
            });
        }
    };


});