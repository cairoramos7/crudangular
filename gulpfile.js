/**
 * Created by cairo on 03/11/2016.
 */
var gulp = require('gulp');
var copy = require('gulp-copy');
var path = require('path');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

var angularPath = './node_modules/angular/angular.min.js',
    jsDest = './public_html/libs/js',
    materiallizeSass = './node_modules/materialize-css/sass/materialize.scss',
    cssDest = './public_html/libs/css';

gulp.task('angularJs', function(){
    return gulp.src(angularPath)
        .pipe(gulp.dest(jsDest));
});

gulp.task('materiallize', function(){
    return gulp.src(materiallizeSass)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssDest));
});

gulp.task('default', function(){
    gulp.run([
        'angularJs',
        'materiallize'
    ]);
});