const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

build = [
   {
      'file_path': 'public/assets/build/js/general.min.js',
      'files': [
         'public/assets/js/components/general.js',
         'public/assets/js/components/slide.js',
      ],
   },
   {
      'file_path': 'public/assets/build/js/main.min.js',
      'files': [
         'public/assets/js/main.js',
      ],
   },
];
buildSass = [
   {
      'file_path': 'public/assets/build/css/general.min.css',
      'files': [
         'public/assets/sass/general.scss',
         'public/assets/sass/pagination.scss',
         'public/assets/sass/slide.scss',
      ],
   },
   {
      'file_path': 'public/assets/build/css/home.min.css',
      'files': [
         'public/assets/sass/home.scss',
      ],
   },
];

build.map(function(item, index) {
   mix.scripts(item.files, item.file_path);
});
buildSass.forEach(function (value) {
    value.files.map((src, index) => {
        mix.sass(src, value.file_path);
    })
});
