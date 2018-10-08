# vim: ft=dockerfile
FROM php:7.0-apache

WORKDIR /var/www/html

RUN docker-php-ext-configure pdo_mysql && \
    docker-php-ext-install pdo_mysql

# docker build -t draft/php:latest -f dockerfile .

