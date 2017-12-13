let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |我们要将编辑器的 CSS 和 JS 文件复制到 public 文件夹下，这样我们才能通过浏览器读取这些文件。我们可以使用 Mix 的 copyDirectory 方法来实现：
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .copyDirectory('resources/assets/editor/js', 'public/js')
   .copyDirectory('resources/assets/editor/css', 'public/css')
   ;
