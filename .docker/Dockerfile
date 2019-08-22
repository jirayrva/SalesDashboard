# FROM php:apache
# SHELL ["/bin/bash", "-c"]
# RUN ln -s ../mods-available/{expires,headers,rewrite}.load /etc/apache2/mods-enabled/
# RUN sed -e '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' -i /etc/apache2/apache2.conf
# COPY php.ini /usr/local/etc/php/

FROM php:7.1.8-apache

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php.ini /usr/local/etc/php/

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite
