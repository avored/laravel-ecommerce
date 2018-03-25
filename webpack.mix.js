let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('themes/avored/default/assets/js/app.js', 'public/vendor/avored-default/js')
   .sass('themes/avored/default/assets/sass/app.scss', 'public/vendor/avored-default/css');



mix.scripts(['modules/avored/ecommerce/resources/assets/js/jquery-3.2.1.min.js',
        'modules/avored/ecommerce/resources/assets/js/popper.min.js',
        'modules/avored/ecommerce/resources/assets/js/bootstrap.min.js',
        'modules/avored/ecommerce/resources/assets/js/Chart.min.js',
        'modules/avored/ecommerce/resources/assets/js/select2.min.js',
        'modules/avored/ecommerce/resources/assets/js/flatpickr.js',
        'modules/avored/ecommerce/resources/assets/js/summernote.js'
        ]
            , 'public/vendor/avored-admin/js/app.js');



mix.sass('modules/avored/ecommerce/resources/assets/sass/app.scss',
    'public/vendor/avored-admin/css');

mix.copy('modules/avored/ecommerce/resources/assets/fonts', 'public/vendor/avored-admin/fonts');
mix.copy('modules/avored/ecommerce/resources/assets/images', 'public/vendor/avored-admin/images');