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

mix.styles([
    'resources/assets/css/materialdesignicons.css',
    'resources/assets/css/animate.css',
    'resources/assets/css/noty.css',
    'resources/assets/css/noty.relax.css',
    'resources/assets/css/argon.css',
    'resources/assets/css/custom.css',
], 'public/app.css');

mix.scripts([
    'resources/assets/js/noty.js',
    'resources/assets/js/jquery.scrollTo.js',
    'resources/assets/js/argon.js',
    'resources/assets/js/custom.js',
], 'public/app.js');

mix.copyDirectory('resources/assets/images', 'public/images');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/vendor', 'public/vendor');

if (mix.inProduction()) {
    mix.version();
}