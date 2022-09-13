FROM php:8.1.1-fpm-alpine

RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN set -eux; apk add libzip-dev; docker-php-ext-install zip

COPY .env.example /var/www/html/.env

RUN apk update \
    && php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/composer-setup.php
