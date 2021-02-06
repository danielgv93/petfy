<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Instalación

1. Crear host virtual con la direccion http://petfy.es. Si no es asi, es probable que alguna imagen no se muestre correctamente
1. Instalar composer desde [aquí](https://getcomposer.org/download/)
2. Ejecutar `composer install`.
3. Clonar el archivo .env.example y cambiarlo de nombre por .env. Cambiar la linea 5 `APP_URL=http://petfy.es` y la linea
13 por el nombre de la base de datos que se haya preparado.
    
5. Ejecutar `php artisan key:generate`.
6. Ejecutar `composer require laravel/jetstream`.
7. Instalar nodejs de [aqui](https://nodejs.org/es/download/) y ejecutar los siguientes comandos:
```
npm install
npm run dev
php artisan migrate
```

8. Ejecutar `php artisan db:seed`.
9. Ejecutar `php artisan storage:link` para poder acceder desde el cliente a las imagenes.
10. Usuario de prueba:
1. Email: dani@gmail.com
2. Password: 123
