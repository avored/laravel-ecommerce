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
mix.config.fileLoaderDirs.fonts     = 'avored-admin/fonts';
mix.config.fileLoaderDirs.images     = 'avored-admin/images';



mix.js('packages/avored/framework/resources/js/app.js', 'public/avored-admin/js');

//mix.js('modules/avored/user/resources/js/app.js', 'public/avored-admin/js/user');
  //.extract(['vue']);

mix.less('packages/avored/framework/resources/less/app.less', 'public/avored-admin/css/app.css', {
    javascriptEnabled: true
  
});
//mix.sass('packages/avored/framework/resources/sass/app.scss', 'public/avored-admin/css/app.css');
