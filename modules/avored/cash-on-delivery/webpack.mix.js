let mix = require('laravel-mix')

let publicPath = '../../../public/vendor/avored'

mix.setPublicPath(publicPath)
    .js('resources/js/cash-on-delivery.js', 'js/cash-on-delivery.js')
