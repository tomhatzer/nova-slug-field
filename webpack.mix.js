let mix = require('laravel-mix')

require('./mix.js')

mix.setPublicPath('dist')
    .js('resources/js/field.js', 'js')
    .sass('resources/sass/field.scss', 'css')
    .vue({version: 3})
    .nova('benjaminhirsch/nova-slug-field')
