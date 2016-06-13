jQuery(document).ready(function () {
    jQuery('select').material_select();
    $('.datepicker').pickadate({});

    jQuery("div#product-images").dropzone({url: "/admin/product/upload-image"});

    var photo_counter = 0;
    Dropzone.options.realDropzone = {
        uploadMultiple: false,
        parallelUploads: 100,
        maxFilesize: 8,
        previewsContainer: '#dropzonePreview',
        previewTemplate: document.querySelector('#preview-template').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove',
        dictFileTooBig: 'Image is bigger than 8MB',
        // The setting up of the dropzone
        init: function () {

            this.on("removedfile", function (file) {

                $.ajax({
                    type: 'POST',
                    url: 'upload/delete',
                    data: {id: file.name},
                    dataType: 'html',
                    success: function (data) {
                        var rep = JSON.parse(data);
                        if (rep.code == 200)
                        {
                            photo_counter--;
                            $("#photoCounter").text("(" + photo_counter + ")");
                        }

                    }
                });

            });
        },
        error: function (file, response) {
            if ($.type(response) === "string")
                var message = response; //dropzone sends it's own error messages in string
            else
                var message = response.message;
            file.previewElement.classList.add("dz-error");
            _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i];
                _results.push(node.textContent = message);
            }
            return _results;
        },
        success: function (file, done) {
            photo_counter++;
            $("#photoCounter").text("(" + photo_counter + ")");
        }
    }



});