
jQuery(document).ready(function () {
    jQuery('select').material_select();
    jQuery('.datepicker').pickadate({
        format: "dd-mmmm-yyyy",
        formatSubmit: 'yyyy/mm/dd',
        hiddenSuffix: ''
    });


    Dropzone.options.myAwesomeDropzone = {
        url: "/admin/product-upload",
        init: function () {

            this.on("success", function (file, response) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {

                    var hiddenElement = document.createElement('input');
                    hiddenElement.type = "hidden";
                    hiddenElement.name = "images[]";
                    hiddenElement.value = response.id;

                    document.getElementById('image_hidden_element').appendChild(hiddenElement);
                    $(file.previewTemplate).find('.del_thumbnail').attr('data-id', response.id);

                }
            });
            this.on("addedfile", function (file) {
                var _this = this;
                y = file;


                /* Maybe display some more file information on your page */
                var removeButton = Dropzone.createElement("<button data-dz-remove " +
                        "class='del_thumbnail btn btn-default'>Delete</button>");



                removeButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    x = e;
                    
                    var data = {id: jQuery(e.target).attr('data-id')};
                    // Do a post request and pass this path and use server-side language to delete the file
                    //          $.post(server_file,{'X-CSRFToken': $cookies.csrftoken}, 'json');
                    jQuery.ajax({
                        method: 'POST',
                        data:data,
                        url: "/admin/remove-product-image",
                    });
                    _this.removeFile(file);
                });
                file.previewElement.appendChild(removeButton);
            });

        }

    };


});