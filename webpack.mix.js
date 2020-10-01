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

 mix.version();
 mix.styles([
     'public/assets_front/vendor/bootstrap/css/bootstrap.min.css',
     'public/assets_front/fonts/themify/themify-icons.css',
     'public/assets_front/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
     'public/assets_front/fonts/elegant-font/html-css/style.css',
     'public/assets_front/vendor/animate/animate.css',
     'public/assets_front/vendor/css-hamburgers/hamburgers.min.css',
     'public/assets_front/vendor/animsition/css/animsition.min.css',
     'public/assets_front/vendor/select2/select2.min.css',
     'public/assets_front/vendor/slick/slick.css',
     'public/assets_front/css/owl.carousel.min.css',
     'public/assets_front/css/util.min.css',
     'public/assets_front/css/main.min.css',
     'public/assets_front/css/estilos.css'
 ], 'public/assets_front/css/combined.min.css');

 mix.scripts([
     'public/assets_front/vendor/jquery/jquery-3.2.1.min.js',
     'public/assets_front/vendor/animsition/js/animsition.min.js',
     'public/assets_front/vendor/bootstrap/js/popper.js',
     'public/assets_front/vendor/bootstrap/js/bootstrap.min.js',
     'public/assets_front/vendor/select2/select2.min.js',
     'public/assets_front/vendor/slick/slick.min.js',
     'public/assets_front/js/slick-custom.js',
     'public/assets_front/js/main.js',
     'public/assets_front/js/owl.carousel.min.js',
     'public/assets_front/js/jquery.instagramFeed.min.js'
 ], 'public/assets_front/js/combined.min.js');
