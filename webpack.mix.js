const mix = require('laravel-mix');

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

mix.options({
  processCssUrls: false
});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/frontend.js', 'public/js/main.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/tailwind.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .sass('resources/css/frontend.scss', 'public/css/main.css');

mix.scripts(['node_modules/croppie/croppie.js', 'node_modules/quill/dist/quill.js', 'node_modules/quill/dist/quill.js'], 'public/js/utils.js');
mix.scripts(['node_modules/croppie/croppie.js'], 'public/js/croppie.js');

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copy( 'resources/img', 'public/img', false );

mix.copy('resources/js/components/pell.js', 'public/js')
mix.copy('resources/css/components/pell.css', 'public/css')


if (mix.inProduction()) {
    mix.version();
}
