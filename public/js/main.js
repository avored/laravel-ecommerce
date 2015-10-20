var main = {
    init: function () {
        var me = main;
        jQuery(document).on('click', '.add_custom_button', me.addCustomButtonOnClick);
        jQuery(document).on('change', '.attribute_type', me.attributeTypeOnChange);


        jQuery(document).on('change', '.image_list .btn-file', me.productFileOnChange);


        jQuery('.select2').select2();
        jQuery(document).on('click', '.product_image_delete',
                function (e) {
                    e.preventDefault();
                    alert("@todo left Delete PRoduct Image")
                });

        var uploader = new ss.SimpleUpload({
            button: jQuery('.image_list .btn-file'),
            url: 'http://my.dev/admin/product/uploadImage',
            name: 'file',
            data: {_token: jQuery('.image_list .btn-file').attr('data-token')},
            onComplete: function (filename, result) {
                jQuery('.image_list .image_file').before(result);
            }

        });


        $(".dropdown").hover(
                function () {
                    $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                    $(this).toggleClass('open');
                    //$('b', this).toggleClass("caret caret-up");                
                },
                function () {
                    $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                    $(this).toggleClass('open');
                    //$('b', this).toggleClass("caret caret-up");                
                });



    },
    addCustomButtonOnClick: function (e) {
        e.preventDefault();
        var me = main;
        var row = jQuery('.custom_attribute_row');
        var htmlstring = row.html();
        var randomString = main.randomString(6);
        htmlstring = htmlstring.replace(/\__UNIQUE__/g, randomString);

        jQuery('.attribute_key_value_row').append(htmlstring);
    },
    randomString: function (limit) {
        var text = "";
        var possible = "abcdefghijklmnopqrstuvwxyz";
        for (var i = 0; i < limit - 1; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    },
    attributeTypeOnChange: function (e) {
        e.preventDefault();
        var me = main;
        if (jQuery(this).val() == "select") {
            jQuery('.attribute_select_option').removeClass('hide');
            me.addCustomButtonOnClick(e);
        }
    },
    productFileOnChange: function (e) {
        var me = main;


        //me.readURL(this);
    },
    readURL: function (input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                jQuery(input).before('<img width="100" src=""  />');
                jQuery(input).addClass('hide');
                jQuery(input).parent().attr('class', '');
                jQuery(input).parent().find('img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

}

jQuery(document).ready(main.init);