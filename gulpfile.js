var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
     assetDir = "./resources/assets";

    elixir(function(mix) {
        mix.styles([
            'plugins/admin-lte/bootstrap/css/bootstrap.min.css',
            'plugins/admin-lte/dist/css/AdminLTE.min.css',
            'plugins/admin-lte/plugins/select2/select2.min.css',
            'plugins/admin-lte/plugins/datepicker/datepicker3.css',
            'plugins/admin-lte//plugins/iCheck/square/blue.css',
            'plugins/admin-lte/dist/css/skins/skin-blue.min.css',

        ],null,assetDir);
        mix.scripts([
            'plugins/admin-lte/plugins/jQuery/jquery-2.2.3.min.js',
            'plugins/admin-lte/bootstrap/js/bootstrap.min.js',
            'plugins/admin-lte/plugins/select2/select2.min.js',
            'plugins/admin-lte/plugins/datepicker/bootstrap-datepicker.js',
            'plugins/admin-lte/plugins/iCheck/icheck.min.js',
            'plugins/admin-lte/dist/js/app.js'
        ],null,assetDir);
        
    });
});
