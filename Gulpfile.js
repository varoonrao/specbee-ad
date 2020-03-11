/**
 * @file
 */

var gulp = require("gulp");
var sass = require("gulp-sass");
var sourcemaps = require("gulp-sourcemaps");
var prefix = require("gulp-autoprefixer");
// Var sassLint = require('gulp-sass-lint');.
var prefixerOptions = {
  overrideBrowserslist: ["last 10 versions"]
};

gulp.task("styles", function() {
  gulp
    .src("scss/**/*.scss")
    // .pipe(sassLint())
    // .pipe(sassLint.format())
    // .pipe(sassLint.failOnError())
    .pipe(sourcemaps.init())
    .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
    // .pipe(sourcemaps.write())
    .pipe(prefix(prefixerOptions))
    .pipe(gulp.dest("css/"));
});

// Watch task.
gulp.task("default", function() {
  gulp.watch("scss/**/*.scss", ["styles"]);
});
