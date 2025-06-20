
FROM php:8.4-cli
WORKDIR /var/www/html
RUN docker-php-ext-install pdo_mysql
CMD ["php", "-S", "0.0.0.0:8000"]
