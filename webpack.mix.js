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

mix.styles([
   'resources/assets/plantilla/css/bootstrap.min.css',
   'resources/assets/plantilla/css/font-awesome.css',
     'resources/assets/plantilla/css/_all-skins.css',
     'resources/assets/plantilla/css/AdminLTE.css',
      'resources/assets/plantilla/css/blue.css',
      'resources/assets/plantilla/css/ionicons.min.css',    
      'resources/assets/plantilla/css/select2.min.css',    
], 'public/css/plantilla.css')
.scripts([
  'resources/assets/plantilla/js/jQuery-2.1.4.min.js',
   'resources/assets/plantilla/js/bootstrap.min.js',
   'resources/assets/plantilla/js/app.min.js',
   'resources/assets/plantilla/js/Chart.min.js',    
   'resources/assets/plantilla/js/sweetalert2.all.js',
   'resources/assets/plantilla/js/popper.min.js',
   'resources/assets/plantilla/js/jquery.sparkline.min.js',
   'resources/assets/plantilla/js/jquery.slimscroll.min.js',
   'resources/assets/plantilla/js/select2.full.min.js',
], 'public/js/plantilla.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');
mix.autoload({
   'jquery': ['$', 'window.jQuery', 'jQuery'],
   'vue': ['Vue','window.Vue'],  
 })
