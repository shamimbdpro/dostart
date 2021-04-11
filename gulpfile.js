
const app = require( './package.json' );
const gulp = require( 'gulp' );
const eslint = require( 'gulp-eslint' );
//const babel = require( 'gulp-babel' );
const prettify = require( 'gulp-js-prettify' );
const uglify = require( 'gulp-uglify' );
const rename = require( 'gulp-rename' );
const sass = require( 'gulp-sass' );
//const sourcemaps = require( 'gulp-sourcemaps' );
const minifyCSS = require( 'gulp-clean-css' );
const autoprefixer = require( 'gulp-autoprefixer' );
const notify = require( 'gulp-notify' );

const config = {
    babel: {
        presets: ['@babel/preset-env']
    },
    prettify: {
        "indent_with_tabs": true
    },
    js: {
        src: ['assets/js/*.js', '!assets/js/**/*.min.js'],
        dist: 'assets/js',
    },
    scss: {
        src: 'assets/css/scss/**/*.scss',
        dist: 'assets/css',
    },
    autoprefixer: {
        options: {
            cascade: false,
        },
    },

};

// Tasks
gulp.task(
    'compile:js',
    () => {
        return gulp.src( config.js.src )
           // .pipe( sourcemaps.init( { largeFile: true } ) )
          //  .pipe( eslint() )
          //  .pipe( eslint.format() )
          //  .pipe( babel( config.babel ) )
            .on( 'error', notify.onError( {title: "Error", message: "Error: <%= error.message %>"} ) ) // phpcs:ignore WordPressVIPMinimum.Security.Underscorejs.OutputNotation
            .pipe( prettify( config.prettify ) )
            // .pipe( gulp.dest( config.js.dist ) )
            .pipe( uglify() )
            .pipe( rename( { suffix: '.min' } ) )
           // .pipe( sourcemaps.write( '/.' ) )
            .pipe( gulp.dest( config.js.dist ) )
            .pipe( notify( {message: 'TASK: compile:js Completed! 💯', onLast: true} ) );
    }
);

gulp.task(
    'compile:scss',
    () => {
        return gulp.src( config.scss.src )
            .pipe( sass().on( 'error', sass.logError ) )
            .on( 'error', notify.onError( {title: "Error", message: "Error: <%= error.message %>"} ) ) // phpcs:ignore WordPressVIPMinimum.Security.Underscorejs.OutputNotation
            .pipe( autoprefixer( config.autoprefixer.options ) )
            .pipe( gulp.dest( config.scss.dist ) )
            .pipe( minifyCSS() )
            .pipe( rename( { suffix: '.min'} ) )
            .pipe( gulp.dest( config.scss.dist ) )
            .pipe( notify( {message: 'TASK: compile:scss Completed! 💯', onLast: true} ) );
    }
);


gulp.task( 'build', gulp.series( 'compile:js', 'compile:scss') );
gulp.task(
    'watch',
    function () {
        gulp.watch( config.scss.src, gulp.series( 'compile:scss' ) );
    }
);
