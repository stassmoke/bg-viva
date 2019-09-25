const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    postCss: [
        require('autoprefixer')({
            overrideBrowserslist: ['last 10 versions'],
            cascade: false,
            grid: true,
            flexbox: "no-2009",
            supports: true
        })
    ]
});

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false
    })
;

mix.browserSync(process.env.MIX_SENTRY_DSN_PUBLIC);
