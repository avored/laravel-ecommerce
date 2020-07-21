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


/******** AVORED ADMIN JS  **********/
mix.js('resources/js/avored.js', 'js/avored.js')
    // .extract(['vue', 'ant-design-vue'])

mix.js('resources/js/app.js', 'js/app.js')

/******** AVORED COPY IMAGES  **********/
mix.copyDirectory('resources/images', 'public/images')


mix.sass('resources/sass/tailwind.scss', 'css/app.css')
.options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
})
