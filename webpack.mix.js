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
ts(['resources/ts/editArticle.tsx'], 'public/js')
.react()
.ts(['resources/ts/editArticleIndex.tsx'], 'public/js')
.react()
.copy('resources/wysiwyg-assets', 'public/wysiwyg-assets')
.sass('resources/sass/wysiwyg.scss', 'public/css')
.postCss('resources/css/app.css', 'public/css',[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
]);