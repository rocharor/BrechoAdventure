let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   // .sass('resources/assets/sass/app.scss', 'public/css');
   .stylus('resources/assets/stylus/app.styl', 'public/css')
   .copyDirectory('node_modules/xzoom', 'public/plugins/xzoom')
   .copyDirectory('node_modules/jquery-jcrop', 'public/plugins/jquery-jcrop');
