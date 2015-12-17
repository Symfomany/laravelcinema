var elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.phpUnit();
    //
    //mix.sass('app.sass');
    //
    //mix.scripts([
    // '*.js'
    //], 'public/dist');
    //
    //mix.styles([
    //    'style.css'
    //]).stylesIn('public/css');
    //
    //
    //mix.sass('*.sass', 'public/css/app.css');
    //
    //
    //mix.scripts([
    //    '*.js'
    //], 'public/js');
});


