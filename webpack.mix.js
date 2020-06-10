const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')
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
    


mix.webpackConfig({
    output: {
        chunkFilename: mix.inProduction() ? "avored-admin/js/chunk/[name].[chunkhash].js" : "avored-admin/js/chunk/[name].js",
    }
})


// mix.webpackConfig({
//     output: {
//         chunkFilename: mix.inProduction() ? "js/chunk/[name].[chunkhash].js" : "js/chunk/[name].js",
//     }
// })
mix.js('resources/js/app.js', 'public/js/app.js');

mix.less('resources/less/app.less', 'public/css/app.css', {
    javascriptEnabled: true,
    modifyVars: {
        'primary-color': '#E64448',
        'link-color': '#C12E32',
        'border-radius-base': '5px',
    },
}).options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
})

let url = process.env.APP_URL.replace(/(^\w+:|^)\/\//, '');
mix.options({
   hmrOptions: {
       host: url,
       port: 8080 // Can't use 443 here because address already in use
   }
});


/******** AVORED ADMIN JS  **********/
mix.js('packages/framework/resources/js/app.js', 'public/avored-admin/js/app.js');
/******** AVORED ADMIN CSS  **********/
mix.less('packages/framework/resources/less/app.less', 'public/avored-admin/css/app.css', {
    javascriptEnabled: true,
    modifyVars: {
        'primary-color': '#E64448',
        'link-color': '#C12E32',
        'border-radius-base': '5px',
    },
}).options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
})
