/**
 *
 * Gulpfile setup
 *
 * @since 1.0.0
 * @author Ibon Azkoitia
 * @package wpbilbao
 * @forks Ahmad Awais - Advanced Gulp Workflow for WordPress Themes
 */


// Project configuration
var url         = 'wpbilbao.es' // Local Development URL for BrowserSync. Change as-needed.

// Load plugins
    var gulp         = require('gulp'),
        browserSync  = require('browser-sync'), // Asynchronous browser loading on .scss file changes
        reload       = browserSync.reload,
        autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
        cache        = require('gulp-cache'),
        concat       = require('gulp-concat'),
        filter       = require('gulp-filter'),
        ignore       = require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
        plugins      = require('gulp-load-plugins')({ camelize: true }),
        newer        = require('gulp-newer'),
        plumber      = require('gulp-plumber'), // Helps prevent stream crashing on errors
        rename       = require('gulp-rename'),
        sass         = require('gulp-sass'),
        scsslint     = require('gulp-scss-lint'),
        sourcemaps   = require('gulp-sourcemaps'),
        uglify       = require('gulp-uglify'),
        minifycss    = require('gulp-uglifycss');



/**
 * Browser Sync
 *
 * Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
*/
gulp.task('browser-sync', function() {
    var files = [
            '**/*.php',
            '**/*.{png,jpg,gif}'
            ];
    browserSync.init(files, {

        // Read here http://www.browsersync.io/docs/options/
        proxy: "https://www.wpbilbao.es",

        port: 8080,

        // Tunnel the Browsersync server through a random Public URL
        tunnel: true,

        // Attempt to use the URL "http://my-private-site.localtunnel.me"
        tunnel: "wpbilbao",

        // Inject CSS changes
        injectChanges: true

    });
});




/**
 * Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 *
 * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
*/
gulp.task('styles', function () {
    return   gulp.src('sass/*.scss')
            .pipe(plumber())
            .pipe(sass({
                errLogToConsole: true,

                outputStyle: 'compressed',
                // outputStyle: 'compact',
                // outputStyle: 'nested',
                // outputStyle: 'expanded',
                precision: 10
            }))
            .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
            .pipe(plumber.stop())
            .pipe(gulp.dest('./'))
            .pipe(filter('**/*.css')) // Filtering stream to only css files
            .pipe(reload({stream:true})) // Inject Styles when style file is created
            .pipe(minifycss({
                maxLineLen: 80
            }))
            .pipe(gulp.dest('./'))
            .pipe(reload({stream:true})) // Inject Styles when min style file is created
});





/**
 * Scripts: Vendors
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/
gulp.task('vendorsJs', function() {
    return   gulp.src(['js/vendor/bootstrap.min.js'])
            .pipe(concat('vendors.min.js'))
            .pipe(gulp.dest('js/'))
            .pipe(uglify())
            .pipe(gulp.dest('js/'))
});

/**
 * Scripts: Custom
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/

gulp.task('scriptsJs', function() {
    return   gulp.src('js/wpbilbao.js')
            .pipe(concat('wpbilbao.min.js'))
            .pipe(gulp.dest('js/'))
            .pipe(uglify())
            .pipe(gulp.dest('js/'))
});


/**
 * Clean gulp cache
 */
 gulp.task('clear', function () {
   cache.clearAll();
 });

 // ==== TASKS ==== //
 // Watch Task
 gulp.task('default', ['styles', 'vendorsJs', 'scriptsJs', 'browser-sync'], function () {
    gulp.watch('sass/**/*.scss', ['styles', browserSync.reload]);
    gulp.watch('js/**/*.js', ['scriptsJs', browserSync.reload]);
 });


// SCSS Lint
gulp.task('scsslint', function () {
    return gulp.src([
        'sass/base/_links.scss',
        'sass/base/_variables.scss',
        'sass/layouts/*.scss',
        '!' + 'sass/*.scss'
    ])
    .pipe(scsslint());
});
