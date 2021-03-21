const mix = require('laravel-mix');

mix
.sass('resource/src/scss/index.scss', 'assets/css/app.css')
.js('resource/src/index.js', 'assets/js/app.js')
.css('resource/src/font-awesome/css/font-awesome.css', 'assets/css')
// .copy('resource/src/font-awesome/webfonts/*', 'assets/webfonts')
// .copy('resource/src/images/*', 'assets/images')
.options({
    processCssUrls: false
})