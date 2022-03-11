const mix = require('laravel-mix');
const path = require('path');
const CKEditorWebpackPlugin = require( '@ckeditor/ckeditor5-dev-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const { styles } = require( '@ckeditor/ckeditor5-dev-utils' );

mix.extend('ckeditor', webpackConfig => {
    const { rules } = webpackConfig.module;
    rules.filter(rule => /svg/.test(rule.test.toString()))
    .forEach(rule => rule.exclude = /@ckeditor/);
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
mix.ckeditor()
.webpackConfig({
    plugins: [
        new CKEditorWebpackPlugin( {
            // See https://ckeditor.com/docs/ckeditor5/latest/features/ui-language.html
            language: 'en'
        } ),
        
        new MiniCssExtractPlugin( {
            filename: 'css/styles.css'
        } )
    ],
    module: {
        rules: [
            {
                test: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
                use: [ 'raw-loader' ]
            },
            {
                test: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: styles.getPostCssConfig( {
                                themeImporter: {
                                    themePath: require.resolve( '@ckeditor/ckeditor5-theme-lark' )
                                },
                                minify: true
                            } )
                        }
                    }
                ],
                sideEffects: true
            }
        ]
    }
})
.js('resources/js/ckEditor.js', 'public/js')
/*.postCss('resources/css/app.css', 'public/css',[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer')
])*/;