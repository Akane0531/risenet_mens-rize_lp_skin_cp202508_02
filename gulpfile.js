const { src, dest, series, watch, lastRun, parallel } = require('gulp');

const cached = require('gulp-cached'),
  changed = require('gulp-changed'),
  debug = require('gulp-debug'),
  fs = require('fs'),
  imagemin = require('gulp-imagemin'),
  mozjpeg = require('imagemin-mozjpeg'),
  notify = require('gulp-notify'),
  path = require('path'),
  plumber = require('gulp-plumber'),
  pngquant = require('imagemin-pngquant'),
  rename = require('gulp-rename'),
  replace = require('gulp-replace'),
  webp = require('gulp-webp');

// CSS related plugins
const autoprefixer = require('gulp-autoprefixer'),
  cleanCSS = require('gulp-clean-css'),
  sass = require('gulp-dart-sass'),
  sassGlob = require('gulp-sass-glob');

// JS related plugins
const webpackStream = require('webpack-stream'),
  webpackConfig = require('./webpack.config'),
  named = require('vinyl-named');

// Browers related plugins
const browserSync = require('browser-sync').create();

// config.json
const json = JSON.parse(fs.readFileSync('./config.json'));

const isProduction = process.env.NODE_ENV === 'production';
const outputPath = isProduction ? './dist' : './dev';
// const outputPath = './';

function errorHandler(err, stats) {
  if (err || (stats && stats.compilation.errors.length > 0)) {
    const error = err || stats.compilation.errors[0].error;
    notify.onError({ message: '<%= error.message %>' })(error);
    this.emit('end');
  }
}

function browserSyncInit(done) {
  browserSync.init({
    open: false,
    proxy: 'http://localhost:8000',
  });
  done();
}

function browserSyncReload(done) {
  browserSync.reload();
  done();
  console.info('Browser reload completed');
}

// pages以下のファイルをコピー&拡張子をhtmlに変換
function copyPages() {
  const baseStream = src(json.paths.pages.target).pipe(plumber({ errorHandler: errorHandler }));
  const resultStream = isProduction ? baseStream.pipe(rename({ extname: '.html' })) : baseStream;
  return resultStream.pipe(dest(outputPath + json.paths.pages.dist)).pipe(browserSync.stream());
}
// include以下のファイルをコピー
function copyInclude() {
  return src(json.paths.include.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(dest(outputPath + json.paths.include.dist))
    .pipe(browserSync.stream());
}

function styles() {
  const option = {
    // outputStyle: isProduction ? 'compressed' : 'expanded',
    outputStyle: 'expanded', // minify無し
    includePaths: [json.paths.styles.src, './node_modules'],
  };

  return src(json.paths.styles.target, { sourcemaps: !isProduction })
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(sassGlob())
    .pipe(sass(option))
    .pipe(
      autoprefixer({
        cascade: false,
        grid: true,
      })
    )
    .pipe(dest(outputPath + json.paths.styles.dist, { sourcemaps: !isProduction }))
    .pipe(debug({ title: 'styles:' }))
    .pipe(browserSync.stream());
}

function minify() {
  return src(outputPath + json.paths.styles.dist + '/**/!(*.min).css', { sourcemaps: true })
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(cached('minify'))
    .pipe(cleanCSS())
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest(outputPath + json.paths.styles.dist, { sourcemaps: './maps' }))
    .pipe(debug({ title: 'minify:' }))
    .pipe(browserSync.stream());
}

function js() {
  return src(json.paths.js.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(
      named((file) => {
        const p = path.parse(file.relative);
        return (p.dir ? p.dir + path.sep : '') + p.name;
      })
    )
    .pipe(webpackStream({ mode: 'production', ...webpackConfig }))
    .pipe(dest(outputPath + json.paths.js.dist))
    .pipe(browserSync.stream());
}

// JSファイルのコピー
function copyJs() {
  return src(json.paths.js.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(dest(outputPath + json.paths.js.dist))
    .pipe(browserSync.stream());
}

// images
function image() {
  return src(json.paths.image.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(changed(json.paths.image.dist))
    .pipe(
      imagemin([
        pngquant({
          quality: [0.65, 0.8], // imagemin-pngquant@7.0.0　から書き方が変更になった
          speed: 1,
          floyd: 0,
        }),
        mozjpeg({
          quality: 85,
          progressive: true,
        }),
        imagemin.svgo(),
        imagemin.optipng(),
        imagemin.gifsicle(),
      ])
    )
    .pipe(dest(outputPath + json.paths.image.dist));
}

function webpImage() {
  return src(json.paths.image.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(
      webp({
        quality: 70,
      })
    )
    .pipe(dest(outputPath + json.paths.image.dist));
}

// コンパイルに関与していない、src内のディレクトリをコピー
function copyOther() {
  return src(json.paths.copy.target)
    .pipe(plumber({ errorHandler: errorHandler }))
    .pipe(dest(outputPath + json.paths.copy.dist));
}

// 特定の文字列を置換する
function replaceAll() {
  const baseStream = src(outputPath + json.paths.pages.dist + '/**/*.{html,inc}').pipe(plumber({ errorHandler: errorHandler }));
  const replacedStream = json.replace.reduce((stream, rule) => stream.pipe(replace(rule.from, rule.to)), baseStream);
  return replacedStream.pipe(dest(outputPath + json.paths.pages.dist));
}

function watchFiles(done) {
  watching = true;
  watch(json.paths.pages.target, series(copyPages, browserSyncReload));
  watch(json.paths.include.target, series(copyInclude, browserSyncReload));
  watch(json.paths.styles.target, styles);
  watch(json.paths.js.src + '/**/*.js', copyJs);
  watch(json.paths.image.target, series(image, webpImage));
  done();
}
// minify する場合は series(styles, minify)
exports.build = parallel(styles, copyJs, series(copyPages, copyInclude, replaceAll), series(image, webpImage), copyOther);
exports.browser = browserSyncInit;
exports.default = series(parallel(styles, copyJs, copyPages, copyInclude, series(image, webpImage)), copyOther, browserSyncInit, watchFiles);
exports.styles = series(styles, minify);
exports.image = series(image, webpImage);
exports.js = copyJs;
exports.page = copyPages;
