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

mix.config.fileLoaderDirs.fonts     = 'vendor/avored-admin/fonts';
mix.config.fileLoaderDirs.images    = 'vendor/avored-admin/images';


mix.js('modules/avored/ecommerce/resources/assets/js/app.js', 'public/vendor/avored-admin/js');
mix.sass('modules/avored/ecommerce/resources/assets/sass/app.scss',  'public/vendor/avored-admin/css');