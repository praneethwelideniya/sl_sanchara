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

mix.js('resources/js/user_profile.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// mix.styles([
//     'public/assets/css/bootstrap.css',
//     'public/assets/style.css',
// 'public/assets/css/animate.css',
// 'public/assets/css/magnific-popup.css',
// 'public/assets/css/slick.css',
// 'public/assets/css/daterangepicker.css',
// 'public/assets/css/typography.css',
// 'public/assets/css/shortcode.css',
// 'public/assets/css/widget.css',
// 'public/assets/css/color.css',
// 'public/assets/css/responsive.css'
// ], 'public/assets/css/all.css');   



// mix.styles('public/svg/svg.css','public/assets/style.css','public/assets/css/dl-menu/component.css');

