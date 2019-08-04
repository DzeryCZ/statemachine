FROM php:7.3-cli-alpine

RUN apk add zip git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./app /app

RUN cd /app && composer install
