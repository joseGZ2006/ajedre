FROM php:8.2-apache

COPY . /var/www/html/ajedre-main/

RUN a2enmod rewrite