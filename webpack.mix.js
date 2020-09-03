const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
require('laravel-mix-alias')

// console.log(process.env.APP_URL)
let url = process.env.APP_URL.replace(/(^\w+:|^)\/\//, '')
mix.options({
   hmrOptions: {
       host: url,
       port: 8081
   }
})

mix.alias({'@': 'resources/js'})

/******** AVORED Global Vue and AvoRed Instance for custom modular component register JS  **********/
mix.js('resources/js/avored.js', 'js/avored.js')
/******** AVORED JS  **********/
mix.js('resources/js/app.js', 'js/app.js')

/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', 'public/images')

/******** AVORED CSS  **********/
mix.sass('resources/sass/tailwind.scss', 'css/app.css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('tailwind.config.js') ],
    })
