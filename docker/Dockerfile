FROM php:7.4-fpm-alpine

RUN apk --no-cache add \
     postgresql-dev \
     curl
RUN docker-php-ext-install opcache exif bcmath pdo pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer