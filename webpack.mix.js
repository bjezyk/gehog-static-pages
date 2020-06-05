const mix = require('laravel-mix');

mix.setPublicPath('assets');

mix.sass('resources/assets/css/admin.scss', 'css');
