FROM php:7.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY ./src/ /var/www/html/
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php.ini /usr/local/etc/php/
