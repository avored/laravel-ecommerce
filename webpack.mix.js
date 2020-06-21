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

mix.alias({'@': '/resources/js'})

class GraphQlLoader {
    webpackRules() {
        return {
            test: /\.(graphql|gql)(\?.*$|$)/,
            loader: 'graphql-tag/loader'
        };
    }
}

mix.extend('graphql', new GraphQlLoader());


mix.js('resources/js/main.js', 'js/app.js').graphql();

mix.sass('resources/sass/tailwind.scss', 'css/app.css')
.options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
})
