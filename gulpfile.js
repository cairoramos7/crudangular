/**
 * Created by cairo on 03/11/2016.
 */
var gulp = require('gulp');
var copy = require('gulp-copy');
var path = require('path');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

var angularPath = './node_modules/angular/angular.min.js',
    materiallizeJs = [
        './node_modules/materialize-css/js/initial.js',
        './node_modules/materialize-css/js/jquery.easing.1.3.js',
        './node_modules/materialize-css/js/animation.js',
        './node_modules/materialize-css/js/velocity.min.js',
        './node_modules/materialize-css/js/hammer.min.js',
        './node_modules/materialize-css/js/jquery.hammer.js',
        './node_modules/materialize-css/js/global.js',
        './node_modules/materialize-css/js/collapsible.js',
        './node_modules/materialize-css/js/dropdown.js',
        './node_modules/materialize-css/js/modal.js',
        './node_modules/materialize-css/js/materialbox.js',
        './node_modules/materialize-css/js/parallax.js',
        './node_modules/materialize-css/js/tabs.js',
        './node_modules/materialize-css/js/tooltip.js',
        './node_modules/materialize-css/js/waves.js',
        './node_modules/materialize-css/js/toasts.js',
        './node_modules/materialize-css/js/sideNav.js',
        './node_modules/materialize-css/js/scrollspy.js',
        './node_modules/materialize-css/js/forms.js',
        './node_modules/materialize-css/js/slider.js',
        './node_modules/materialize-css/js/cards.js',
        './node_modules/materialize-css/js/chips.js',
        './node_modules/materialize-css/js/pushpin.js',
        './node_modules/materialize-css/js/buttons.js',
        './node_modules/materialize-css/js/transitions.js',
        './node_modules/materialize-css/js/scrollFire.js',
        './node_modules/materialize-css/js/date_picker/picker.js',
        './node_modules/materialize-css/js/date_picker/picker.date.js',
        './node_modules/materialize-css/js/character_counter.js',
        './node_modules/materialize-css/js/carousel.js'
    ],
    jqueryPath = './node_modules/jquery/dist/jquery.min.js',
    jsDest = './public_html/libs/js',
    materiallizeSass = './node_modules/materialize-css/sass/materialize.scss',
    cssDest = './public_html/libs/css';

gulp.task('angularJs', function(){
    return gulp.src(angularPath)
        .pipe(gulp.dest(jsDest));
});

gulp.task('materialSass', function(){
    return gulp.src(materiallizeSass)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssDest));
});

gulp.task('materialJs', function(){
    return gulp.src(materiallizeJs)
        .pipe(concat('materiallize.js'))
        .pipe(gulp.dest(jsDest));
});

gulp.task('fonts', function(){
    return gulp.src('./node_modules/materialize-css/fonts/roboto/*.*')
        .pipe(gulp.dest('./public_html/libs/fonts/roboto/'));
});

gulp.task('copyScript', function(){
    return gulp.src(jqueryPath)
        .pipe(gulp.dest(jsDest));
});

gulp.task('default', function(){
    gulp.run([
        'angularJs',
        'materialSass',
        'fonts',
        'copyScript',
        'materialJs'
    ]);
});