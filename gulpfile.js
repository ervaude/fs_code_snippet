/*global require*/
const { series, src, dest } = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    privatePath = 'Resources/Private/',
    prismBasePath = 'node_modules/prismjs/',
    customBasePath = privatePath + 'JavaScript/';

function buildJs() {
    'use strict';
    return src([
        prismBasePath + 'components/prism-core.min.js',
        prismBasePath + 'components/prism-markup-templating.min.js',
        prismBasePath + 'components/prism-markup.min.js',
        prismBasePath + 'components/prism-apacheconf.min.js',
        prismBasePath + 'components/prism-css.min.js',
        prismBasePath + 'components/prism-clike.min.js',
        prismBasePath + 'components/prism-javascript.min.js',
        prismBasePath + 'components/prism-json.min.js',
        prismBasePath + 'components/prism-bash.min.js',
        prismBasePath + 'components/prism-php.min.js',
        prismBasePath + 'components/prism-less.min.js',
        prismBasePath + 'components/prism-php-extras.min.js',
        prismBasePath + 'components/prism-sql.min.js',
        prismBasePath + 'components/prism-yaml.min.js',
        customBasePath + 'prism-typoscript.js',
        prismBasePath + 'plugins/toolbar/prism-toolbar.min.js',
        prismBasePath + 'plugins/file-highlight/prism-file-highlight.min.js',
        prismBasePath + 'plugins/line-numbers/prism-line-numbers.min.js',
        prismBasePath + 'plugins/show-language/prism-show-language.min.js',
        prismBasePath + 'plugins/command-line/prism-command-line.min.js'
    ])
        .pipe(concat('FsCodeSnippet.js'))
        .pipe(uglify())
        .pipe(dest('Resources/Public/JavaScript/'));
}

function buildCss() {
    'use strict';
    return src([
            prismBasePath + 'themes/*.css',
            prismBasePath + 'plugins/toolbar/prism-toolbar.css',
            prismBasePath + 'plugins/line-numbers/prism-line-numbers.css',
            prismBasePath + 'plugins/command-line/prism-command-line.css'
        ])
        .pipe(dest('Resources/Public/CSS/'));
}


exports.build = series(buildJs, buildCss);
exports.buildCss = buildCss;