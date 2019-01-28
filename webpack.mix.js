let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .stylus('resources/assets/stylus/app.styl', 'public/css')
    .copyDirectory('node_modules/croppr/dist', 'public/node_modules/croppr/dist');
    // .copyDirectory('node_modules/vue', 'public/node_modules/vue')
    // .copyDirectory('node_modules/jquery-jcrop', 'public/plugins/jquery-jcrop')
    // .copyDirectory('node_modules/bootstrap', 'public/node_modules/bootstrap')
    // .copyDirectory('node_modules/animate.css', 'public/node_modules/animate.css')
    // .copyDirectory('node_modules/jquery', 'public/node_modules/jquery')
    // .copyDirectory('node_modules/bootstrap-notify', 'public/node_modules/bootstrap-notify');
