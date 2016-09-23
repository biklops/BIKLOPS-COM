var gulp = require('gulp'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	cssnano = require('gulp-cssnano'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	rename = require('gulp-rename'),
	concat = require('gulp-concat'),
	notify = require('gulp-notify'),
	mmq = require('gulp-combine-mq'),
	zip = require('gulp-zip'),
	urlAdjuster = require('gulp-css-url-adjuster'),
	clean = require('gulp-clean');

var pluginSRC = '../../../plugins/enfold-tweaks/';

var sassSRC = './sass/style-tweaks.scss';
var sassDestination     = './temp/';

var mediaSRC = '../js/mediaelement/skin-1/mediaelementplayer.css';
var mediaDEST = './temp';

var styleSRC = [ '../css/grid.css', '../css/base.css', '../css/layout.css', '../css/shortcodes.css', '../js/aviapopup/magnific-popup.css', './temp/mediaelementplayer.css', '../config-gravityforms/gravity-mod.css', './temp/style-tweaks.css' ];

var styleDestination     = './assets/css/';

var printSRC             = '../css/print.css';
var printDestination     = './assets/css/';

var jsSRC          = [ '../js/avia.js', '../js/shortcodes.js', '../js/aviapopup/jquery.magnific-popup.min.js' ];

var jsDestination  = './assets/js/';

var compatSRC             = '../js/avia-compat.js';
var compatDestination     = './assets/js/';

var imgSRC            = '../js/mediaelement/skin-1/*.{png,jpg,gif,svg}';
var imgDestination    = './assets/img/';


gulp.task('sass', function() {
  return sass(sassSRC, { style: 'expanded' })
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest(sassDestination))
    .pipe( notify( { message: 'TASK: "Sass" Completed! 💯', onLast: true } ) );
});

gulp.task('imgfix', function() {
	gulp.src( mediaSRC )
			.pipe(urlAdjuster({
	  				prepend: '../img/',
	}))
	.pipe(gulp.dest(mediaDEST));
});

gulp.task('print', function() {

	gulp.src( printSRC )
			  .pipe(gulp.dest(printDestination))
			  .pipe(rename({suffix: '.min'}))
			  .pipe(cssnano())
			  .pipe(gulp.dest(printDestination))
			  .pipe( notify( { message: 'TASK: "Print styles" Completed! 💯', onLast: true } ) );

});

gulp.task('styles', function() {

	gulp.src( styleSRC )
			  .pipe(concat('enfold-styles.css'))
			  .pipe(gulp.dest(styleDestination))
			  .pipe( mmq( { log: true } ) ) // Merge Media Queries only for .min.css version.
			  .pipe(rename({suffix: '.min'}))
			  .pipe(cssnano())
			  .pipe(gulp.dest(styleDestination))
			  .pipe( notify( { message: 'TASK: "Styles" Completed! 💯', onLast: true } ) );
});

gulp.task('scripts', function() {

	gulp.src( jsSRC )
			.pipe(concat('enfold-scripts.js'))
			.pipe(gulp.dest(jsDestination))
			.pipe(rename({suffix: '.min'}))
			.pipe(uglify())
			.pipe(gulp.dest(jsDestination))
			.pipe( notify( { message: 'TASK: "scripts" Completed! 💯', onLast: true } ) );

	gulp.src( compatSRC )
			  .pipe(gulp.dest(jsDestination))
			  .pipe(rename({suffix: '.min'}))
			  .pipe(uglify())
			  .pipe(gulp.dest(compatDestination))
 		.pipe( notify( { message: 'TASK: "compat js" Completed! 💯', onLast: true } ) );
});

gulp.task( 'images', function() {
	gulp.src( imgSRC )
		.pipe(imagemin({ optimizationLevel: 1, progressive: true, interlaced: true }))
		.pipe(gulp.dest( imgDestination ))
		.pipe( notify( { message: 'TASK: "images" Completed! 💯', onLast: true } ) );
});


gulp.task('backup', function() {
    return gulp.src( pluginSRC +'**/*')
        .pipe( zip( 'enfold-tweaks-backup.zip' ) )
        .pipe( gulp.dest( './temp' ) )
        .pipe( notify( { message: 'Backup Created!' } ) );
});

gulp.task('clean', ['backup'], function() {
	return gulp.src( pluginSRC, { read: false } )
	    .pipe( clean( { force: true } ) );
});

gulp.task('dist', ['clean'],  function() {
	gulp.src(['./**/*', '!./temp', '!./temp/**', '!./node_modules', '!./node_modules/**', '!./package.json', '!./gulpfile.js', '!./.git', '!./.gitignore', '!./sass', '!./sass/**'])
        .pipe(gulp.dest( pluginSRC ) )
        .pipe( zip( 'enfold-tweaks.zip' ) )
        .pipe( gulp.dest( './dist' ) );
});


// gulp.task('default', ['styles', 'scripts']);

gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts', 'images');
});
