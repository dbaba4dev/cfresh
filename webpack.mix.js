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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
    // .sass('resources/sass/global.scss', 'public/css');

mix.styles([
    'resources/css/fontawesome/all.min.css',
    'resources/css/ionicons.min.css',
    'resources/css/adminlte.min.css',
    'resources/css/fonts.googleapis.css',
    'resources/css/select2.min.css',
    'resources/css/select2-bootstrap4.min.css'

], 'public/css/all.css');

mix.scripts([
    'resources/js/jquery.min.js',
    'resources/js/bootstrap.bundle.min.js',
    // 'resources/js/bootstrap.bundle.min.js.map',
    'resources/js/adminlte.min.js',
    'resources/js/select2.full.min.js',
    'resources/js/demo.js'
], 'public/js/all.js');
