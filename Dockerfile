# Dockerfile
FROM php:8.2-apache

# Habilitar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite para URLs limpias
RUN a2enmod rewrite

# Copiar archivos del proyecto al contenedor
COPY . /var/www/html/

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto
EXPOSE 80
