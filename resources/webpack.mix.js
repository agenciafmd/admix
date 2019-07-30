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

/*
* Define o diretorio que iremos salvar os arquivos processados do sass
* */
mix.setPublicPath('../src/resources');

/*
* Compilando o sass
* */
mix.sass('sass/bundle.scss', 'css/admix.css');

/*
* Compilando o javascript
* */
// mix.js('js/app.js', 'js/admix.js');

/*
* Copiando arquivos locais
* */
// mix.copyDirectory('images/local', '../src/resources/images');