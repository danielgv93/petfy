#!/bin/bash

# Espera a que la base de datos esté lista (opcional pero recomendado)
# Puedes modificar este bucle según tu configuración de base de datos
# while ! nc -z db 3306; do
#   sleep 1
# done

# Genera la clave de la aplicación si no existe
echo "Generando clave de aplicación Laravel..."
chmod 777 /var/www/html/.env
php artisan key:generate
echo "Clave generada."

# Ejecuta las migraciones de la base de datos
echo "Ejecutando migraciones de la base de datos..."
php artisan migrate
echo "Migraciones ejecutadas."


echo "Poblando la base de datos..."
php artisan db:seed
echo "Población ejecutada."

echo "Linkeando storage..."
php artisan storage:link
echo "Storage linkeado."

# Ejecuta el comando pasado al contenedor (en este caso, 'php-fpm')
exec "$@"
