FROM php:8.2-apache

# Instala extensiones de MySQL/PDO
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copia tu código (ajusta la ruta según tu estructura)
COPY ajedre-main/ /var/www/html/

# Habilita mod_rewrite
RUN a2enmod rewrite