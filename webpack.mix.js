const mix = require('laravel-mix');
const path = require('path')
const cssImport = require('postcss-import')
const cssNesting = require('postcss-nesting')

const webpackConfig = require('./webpack.config');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        // prettier-ignore
        cssImport(),
        cssNesting(),
        require('tailwindcss'),
    ])
    .webpackConfig(webpackConfig)
    .version()
    .sourceMaps();
