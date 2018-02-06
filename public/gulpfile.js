var gulp = require('gulp');
var uglify = require('gulp-uglify');
var stylus = require('gulp-stylus');
var concat = require('gulp-concat');

//Cria os arquivos css e minify em apenas 1 arquivo
gulp.task('minifyCSS', function () {
    gulp.src('../resources/assets/stylus/site/*.styl')
        .pipe(stylus({
            compress: true
        }))
        .pipe(concat('site.min.css'))
        .pipe(gulp.dest('css/'));

    gulp.src('../resources/assets/stylus/admin/*.styl')
        .pipe(stylus({
            compress: true
        }))
        .pipe(concat('admin.min.css'))
        .pipe(gulp.dest('css/'));
});

//Cria os arquivos js e minify em apenas 1 arquivo
gulp.task('minifyJS', function () {
    gulp.src('../resources/assets/js/site/*.js')
        .pipe(concat('site.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js/'));

    gulp.src('../resources/assets/js/admin/*.js')
        .pipe(concat('admin.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('js/'));
});

//Image Task Compress
gulp.task('minifyIMG', function () {

});

//Otimza JS CSS IMG
gulp.task( 'otimizar', function() {
    gulp.run('minifyCSS', 'minifyJS', 'minifyIMG');
});

//Roda watch no stylus
gulp.task( 'default', function() {
    gulp.watch(['../resources/assets/stylus/site/*.styl', '../resources/assets/stylus/admin/*.styl'], ['minifyCSS']);
});
