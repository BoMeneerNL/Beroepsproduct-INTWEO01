FROM php:8.4-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
