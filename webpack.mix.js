let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .extract(['axios', 'bootstrap-sass', 'jquery', 'laravel-echo', 'lodash', 'moment', 'vue'])
    .copy('node_modules/font-awesome/fonts', 'public/fonts');

if (mix.config.inProduction) {
    mix.disableNotifications();
    mix.version();
}

mix.autoload({
    'jquery': ['jQuery', '$'],
});

mix.browserSync({
    proxy: 'weather.app:8000',
    browser: "google chrome"
});
