var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var minifyCss = require('gulp-minify-css');

gulp.task('uglify-1', function(){
	gulp.src(['js/jquery.autocomplete1.js', 'js/jquery.magnific-popup.min.js'])
	.pipe(uglify())
	.pipe(concat('first.js'))
	.pipe(gulp.dest('js_build'));
});
gulp.task('uglify-2', function(){
	gulp.src(['js/chosen.jquery.js', 'js/ImageSelect.jquery.js', 'js/jquery.counterup.min.js', 'js/waypoints.min.js',])
	.pipe(uglify())
	.pipe(concat('second.js'))
	.pipe(gulp.dest('js_build'));
});
gulp.task('minify-css', function(){
	gulp.src(['css/autocomplete.css', 'css/styles-with-currency.css', 'css/stylesheets.css', 'css/jquery.bxslider.css', 'css/chosen.css', 'css/magnific-popup2.css'])
	.pipe(minifyCss())
	.pipe(concatCss('all.css'))
	.pipe(gulp.dest('css_build'));
});

gulp.task('watch', function(){
	gulp.watch('js/*.js', ['uglify']);
	gulp.watch('css/*.css', ['minify-css']);
})

// gulp.task('default', ['uglify', 'minify-css', 'watch']);
gulp.task('default', ['minify-css', 'uglify-1', 'uglify-2']);