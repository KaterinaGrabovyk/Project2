FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip

#* command for composer   
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#* command to be able to use mySql
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www