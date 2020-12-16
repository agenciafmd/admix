const mix = require('laravel-mix');

let scripts = require('./js/scripts');

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
mix.babel(scripts, '../src/resources/js/admix.js');

/*
* Copiando arquivos locais
* */
mix.copyDirectory('images', '../src/resources/images');
