/*global require*/
var gulp   = require('gulp'),
    concat = require('gulp-concat'),
    prismBasePath = 'Resources/Private/bower_components/prism/';

gulp.task('build', function () {
    'use strict';
    gulp.start(['build-js', 'build-css']);
});

gulp.task('build-js', function () {
    'use strict';
    return gulp.src([
            prismBasePath + 'components/prism-core.js',
            prismBasePath + 'components/prism-markup.js',
            prismBasePath + 'components/prism-apacheconf.js',
            prismBasePath + 'components/prism-css.js',
            prismBasePath + 'components/prism-clike.js',
            prismBasePath + 'components/prism-javascript.js',
            prismBasePath + 'components/prism-json.js',
            prismBasePath + 'components/prism-bash.js',
            prismBasePath + 'components/prism-php.js',
            prismBasePath + 'components/prism-less.js',
            prismBasePath + 'components/prism-php-extras.js',
            prismBasePath + 'components/prism-sql.js',
            prismBasePath + 'plugins/file-highlight/prism-file-highlight.js',
            prismBasePath + 'plugins/line-numbers/prism-line-numbers.js',
            prismBasePath + 'plugins/show-language/prism-show-language.js',
            prismBasePath + 'plugins/command-line/prism-command-line.js'
    ])
        .pipe(concat('FsCodeSnippet.js'))
        .pipe(gulp.dest('Resources/Public/JavaScript/'));
});

gulp.task('build-css', function () {
    'use strict';
    return gulp.src([
            prismBasePath + 'themes/*.css',
            prismBasePath + 'plugins/line-numbers/prism-line-numbers.css',
            prismBasePath + 'plugins/show-language/prism-show-language.css',
            prismBasePath + 'plugins/command-line/prism-command-line.css'
        ])
        .pipe(gulp.dest('Resources/Public/CSS/'));
});
