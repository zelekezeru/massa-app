const mix = require('laravel-mix');

mix.js('resources/js/bootstrap.js', 'public/js')
   .vue()
   .sass('resources/css/app.scss', 'public/css')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ])
   .version()
   .sourceMaps();