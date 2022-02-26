const mix = require('laravel-mix');
const path = require('path');

mix.extend('quill', webpackConfig => {
    const { rules } = webpackConfig.module;

    // 1. Exclude quill's SVG icons from existing rules
    rules.filter(rule => /svg/.test(rule.test.toString()))
        .forEach(rule => rule.exclude = /quill/);

    // 2. Instead, use html-loader for quill's SVG icons
    rules.unshift({
        test: /\.svg$/,
        include: [path.resolve('./node_modules/quill/assets')],
        use: [{ loader: 'html-loader', options: { minimize: true } }]
    });

    // 3. Don't exclude quill from babel-loader rule
    rules.filter(rule => rule.exclude && rule.exclude.toString() === "/(node_modules|bower_components)/")
        .forEach(rule => rule.exclude = /node_modules\/(?!(quill)\/).*/);
});

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
.css('resources/css/app.css', 'public/css')
.quill();