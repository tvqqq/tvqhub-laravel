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

mix.disableNotifications();

/* App */
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

/* Package deep */
// mix.copyDirectory('packages/deep/resources/assets', 'public/packages/deep');

/* Url Shortlink (resources/views/url/site) */
// mix.js('resources/views/url/site/url.js', 'public/js');

/* Facebooker */
// mix.js('resources/views/facebooker/facebooker.js', 'public/js');
