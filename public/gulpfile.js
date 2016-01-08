var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var minifyCss = require('gulp-minify-css');

gulp.task('uglify', function(){
	gulp.src(['js/jquery/1.10.2/jquery.min.js', 'js/jquery.autocomplete1.js', 'js/jquery.magnific-popup.min.js', 'js/waypoints.min.js', 'js/jquery.counterup.min.js', 'js/chosen.jquery.js', 'js/ImageSelect.jquery.js'])
	.pipe(uglify())
	.pipe(concat('all.js'))
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
gulp.task('default', ['minify-css', 'uglify']);