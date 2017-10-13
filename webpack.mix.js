const mix = require('laravel-mix');
const webpack = require('webpack');

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

mix
    .setPublicPath('public')
    .react('resources/assets/js/app.js', 'public/js')
    // .less('resources/assets/less/app.less', 'public/css')
    .copy('resources/assets/img', 'public/img')
    .sourceMaps()
    .copy('public', '../../../public/vendor/lapse')
    // .copy('public', '../app/public/vendor/horizon')
    .version();


mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
});