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
.js('resources/assets/js/js.js', 'public/js')
.js('resources/assets/js/admin.js', 'public/admin/js')
.js('resources/assets/js/other.js', 'public/js')
.js('resources/assets/js/schedule_calendar.js', 'public/js')
.js('resources/assets/js/videocall.js', 'public/js')
.js('resources/assets/js/dynamic.js', 'public/js')
.sass('resources/assets/sass/app.scss', 'public/css')
.sass('resources/assets/sass/calendar.scss', 'public/css');
