let mix = require('laravel-mix')

// let publicPath = 'dist'
let publicPath = '../../../public'

mix.setPublicPath(publicPath)
    .js('resources/js/cash-on-delivery.js', 'vendor/avored/js/cash-on-delivery.js')
