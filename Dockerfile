FROM php:7.2-apache

RUN apt-get update && apt-get install --no-install-recommends --no-install-suggests -y \
    wget \
    zlib1g-dev \
    && /usr/local/bin/docker-php-ext-install zip

COPY code /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php
RUN /var/www/html/composer.phar install

RUN rm -rf /var/www/html/var/cache
RUN rm -rf /var/www/html/var/logs
RUN rm -rf /var/www/html/var/sessions

RUN mkdir /var/www/html/var/cache
RUN mkdir /var/www/html/var/logs
RUN mkdir /var/www/html/var/sessions

RUN chmod -R 777 /var/www/html/var/cache
RUN chmod -R 777 /var/www/html/var/logs
RUN chmod -R 777 /var/www/html/var/sessions
