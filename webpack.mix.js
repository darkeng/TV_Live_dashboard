let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/dist/js')
   .sass('resources/assets/sass/app.scss', 'public/dist/css');

mix.styles(['bower_components/bootstrap/dist/css/bootstrap.css',
            'bower_components/bootstrap-social/bootstrap-social.css',
            'bower_components/bootstrap-select/dist/css/bootstrap-select.css',
            'bower_components/metisMenu/dist/metisMenu.css',
            'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css',            
            'bower_components/datatables-responsive/css/dataTables.responsive.css',
            'bower_components/font-awesome/css/font-awesome.css',
            'bower_components/sweetalert2/dist/sweetalert2.css'
], 'public/vendor/css/all.css');

mix.scripts(['bower_components/jquery/dist/jquery.js',
            'bower_components/jquery-validation/dist/jquery.validate.js',
            'bower_components/jquery-validation/src/localization/messages_es.js',
            'bower_components/bootstrap/dist/js/bootstrap.js',
            'bower_components/bootstrap-select/dist/js/bootstrap-select.js',
            'bower_components/metisMenu/dist/metisMenu.js',
            'bower_components/datatables/media/js/jquery.dataTables.min.js',
            'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js', 
            'bower_components/datatables-responsive/js/dataTables.responsive.js',
            'bower_components/sweetalert2/dist/sweetalert2.js'
], 'public/vendor/js/all.js');

mix.copyDirectory('bower_components/bootstrap/dist/fonts', 'public/vendor/fonts');
mix.copyDirectory('bower_components/datatables/media/images', 'public/vendor/images');
mix.copyDirectory('bower_components/font-awesome/fonts', 'public/vendor/fonts');
