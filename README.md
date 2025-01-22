<p align="center"><a href="https://fmd.ag" target="_blank"><img src="https://raw.githubusercontent.com/agenciafmd/admix/v10/docs/fmd.png" alt="Logo da F&MD"></a></p>

<p align="center">
<a href="https://packagist.org/packages/agenciafmd/admix"><img src="https://img.shields.io/packagist/dt/agenciafmd/admix" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/agenciafmd/admix"><img src="https://img.shields.io/packagist/v/agenciafmd/admix" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/agenciafmd/admix"><img src="https://img.shields.io/packagist/l/agenciafmd/admix" alt="License"></a>
</p>

## Tabler

Estamos usando o [Tabler](https://tabler.github.io/) como base para o nosso layout.

https://github.com/tabler/tabler/commit/fc91e6ae8cad5ed3d2b17181b48348753222ce14

## Instalação

Create a new Laravel application:

```bash
composer create-project laravel/laravel:v10.x-dev laravel10
```

Change the `minimum-stability` to `dev` in your composer.json file.

Require admix package:

```bash
composer require agenciafmd/admix:v10.x-dev agenciafmd/admix-postal:v10.x-dev agenciafmd/admix-leads:v10.x-dev agenciafmd/admix-analytics:v10.x-dev 
```

Install admix package:

```bash
php artisan admix:install
```