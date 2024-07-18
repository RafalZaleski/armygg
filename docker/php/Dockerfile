FROM php:8.3-fpm

WORKDIR /var/www/html/arrmygg

RUN apt-get update
RUN apt-get install -y libzip-dev zip libicu-dev libpng-dev libcurl4-gnutls-dev curl
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql mysqli exif zip intl gd curl

COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
USER www