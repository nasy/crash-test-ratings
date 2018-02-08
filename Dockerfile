FROM php:7.2-apache

RUN apt-get update && \
    apt-get clean

COPY code /var/www/html/
