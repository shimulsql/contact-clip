const mix = require('laravel-mix');


mix
.autoload({  // or Mix.autoload() ?
    'jquery': ['$', 'window.jQuery', 'jQuery']
  })
.sass('resource/src/scss/index.scss', 'assets/css/app.css')
.js('resource/src/index.js', 'assets/js/app.js')
.js('node_modules/jquery/dist/jquery.min.js', 'assets/js/jquery.min.js')
.css('resource/src/font-awesome/css/font-awesome.css', 'assets/css')
// .copy('resource/src/font-awesome/webfonts/*', 'assets/webfonts')
// .copy('resource/src/images/*', 'assets/images')
.options({
    processCssUrls: false
})