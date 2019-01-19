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

mix.js('vendor/avored/framework/resources/js/app.js', 'public/vendor/avored-admin/js')
    .sass('vendor/avored/framework/resources/sass/app.scss', 'public/vendor/avored-admin/css')
   // .copyDirectory('vendor/avored/framework/resources/assets/static/images','public/vendor/avored-admin/images');
