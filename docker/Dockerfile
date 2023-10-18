FROM php:8.2-fpm as php

RUN apt-get update && apt-get install -y \ 
    git \
    curl \
    zip \
    unzip

WORKDIR /var/www

RUN docker-php-ext-install mysqli