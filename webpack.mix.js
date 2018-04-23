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
   .sass('resources/assets/sass/app.sass', 'public/css')
   .sass('resources/assets/sass/main.sass', 'public/css')
   .sass('resources/assets/sass/landing.sass', 'public/css')//End of general section
   .sass('resources/assets/sass/restaurants/main.sass', 'public/css/restaurants')
   .sass('resources/assets/sass/restaurants/category/main.sass', 'public/css/restaurants/category')
   .sass('resources/assets/sass/restaurants/category/form.sass', 'public/css/restaurants/category')//End of restaurants section
   .sass('resources/assets/sass/admin/restaurants/main.sass', 'public/css/admin/restaurants');//End of admin section.
