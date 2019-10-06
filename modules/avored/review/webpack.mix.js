let mix = require('laravel-mix')

mix.setPublicPath('dist')
    .js('resources/js/review.js', 'js/front/review.js')

mix.setPublicPath('dist')
    .js('resources/js/admin.js', 'js/admin/review.js')
