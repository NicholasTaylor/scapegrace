const mix = require('laravel-mix');

mix./*webpackConfig({
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/,
                use: ['sass-loader']
            }
        ]
    }
})*/
ts('resources/ts/wysiwyg.ts', 'public/js')
.copy('resources/wysiwyg-assets', 'public/wysiwyg-assets')
.sass('resources/sass/wysiwyg.scss', 'public/css')
.postCss('resources/css/app.css', 'public/css',[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
]);