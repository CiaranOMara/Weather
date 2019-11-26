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
    .extract(['axios', 'bootstrap', 'jquery', 'lodash', 'moment', 'vue']);

mix.sass('resources/sass/app.scss', 'public/css');

mix.version();

mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

if (mix.config.inProduction) {
    mix.disableNotifications();
    // mix.version();
}

mix.autoload({
    'jquery': ['jQuery', '$'],
});

mix.browserSync({
    proxy: 'weather.app:8000',
    browser: "google chrome"
});
