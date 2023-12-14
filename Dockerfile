# Usar una imagen de PHP con Apache
FROM php:8.0-apache

# Instalar extensiones de PHP y herramientas necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
  && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html

# Instalar dependencias de Composer (sin scripts y en modo no interactivo)
RUN composer install --no-scripts --no-interaction --prefer-dist

# Configurar el DocumentRoot de Apache para apuntar al directorio public de Laravel
RUN echo 'DocumentRoot /var/www/html/public/' > /etc/apache2/sites-available/000-default.conf

# Ejecutar composer require laravel/jetstream
RUN composer require laravel/jetstream

# Instalar Node.js
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -     && apt-get install -y nodejs

# Ejecutar comandos de NPM y PHP Artisan
RUN npm install && npm run dev

# Copia un script de inicialización personalizado (opcional)
COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh


EXPOSE 80


# Ejecuta el script de inicialización al iniciar el contenedor
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]