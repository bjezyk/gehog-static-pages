const mix = require('laravel-mix');

mix.setPublicPath('assets');

mix.sass('resources/assets/admin/admin.scss', 'admin/css');
mix.js('resources/assets/admin/admin.js', 'admin/js');
