const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
require('gulp-minify-css');
var stylus = require('gulp-stylus');
var concat = require('gulp-concat');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});

gulp.task('unificacss', function() {
    gulp.src([
        'Public/css/*.css'
    ])
    .pipe(concat('css.min.css'))
    .pipe(gulp.dest('Public/css/'))
});

gulp.task('stylus', function () {
  gulp.src('resources/assets/stylus/*.styl')
    .pipe(stylus({
      compress: true
    }))
    .pipe(gulp.dest('Public/css/'))
});

//Roda watch no stylus
gulp.task( 'default', function() {
    gulp.watch('resources/assets/stylus/*.styl', ['stylus']);
});
