var gulp = require('gulp');
var minifyCss = require('gulp-minify-css');
var stylus = require('gulp-stylus');
var concat = require('gulp-concat');

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
      compress: false
    }))
    .pipe(gulp.dest('Public/css/'))
});

//Roda watch no stylus
gulp.task( 'default', function() {
    gulp.watch('resources/assets/stylus/*.styl', ['stylus']);
});
