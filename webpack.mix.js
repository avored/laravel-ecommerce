const mix = require('laravel-mix');

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


mix.js('resources/js/app.js', 'public/js/app.js')
    .less('resources/less/app.less', 'public/css/app.css', {
        javascriptEnabled: true
    })
    .less('vendor/avored/framework/resources/less/app.less', 'public/avored-admin/css/app.css', {
        javascriptEnabled: true
    })
    .js('vendor/avored/framework/resources/js/app.js', 'public/avored-admin/js/app.js');
