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


mix.config.fileLoaderDirs.fonts     = "vendor/avored-default/fonts";
mix.config.fileLoaderDirs.images    = "vendor/avored-default/images";

mix.copy('themes/avored/default/assets/images', 'public/vendor/avored-default/images');
mix.sass('themes/avored/default/assets/sass/app.scss', 'vendor/avored-default/css');
mix.js('themes/avored/default/assets/js/app.js', 'vendor/avored-default/js');