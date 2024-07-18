FROM php:8.0-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY css /var/www/html/css
COPY js /var/www/html/js
COPY php /var/www/html/php
COPY index.php /var/www/html/
COPY login.php /var/www/html/
COPY register.php /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

RUN a2enmod rewrite
