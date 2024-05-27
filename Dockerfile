FROM node:18-alpine as frontend

# Install dependencies
RUN apk add --no-cache \
    autoconf \
    automake \
    bash \
    g++ \
    libc6-compat \
    libjpeg-turbo-dev \
    libpng-dev \
    make \
    nasm

WORKDIR /app

COPY . .

RUN yarn install \
    --silent \
    --pure-lockfile \
    --ignore-optional \
    --non-interactive \
    --prefer-offline \
    --cache-folder .yarn \
    --network-timeout 1000000 # Temporary fix for network timeouts due to rate limiting

RUN yarn build

FROM php:8.2-fpm-alpine3.16

LABEL maintainer="Isaque de Souza Barbosa"

ENV TZ=America/Sao_Paulo

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apk add --no-cache \
    $PHPIZE_DEPS \
    bash \
    nginx \
    supervisor \
    unzip \
    git \
    pkgconfig \
    icu-dev \
    curl-dev \
    openssl-dev \
    oniguruma-dev \
    readline-dev \
    libmcrypt-dev \
    libxslt-dev \
    make \
    musl-dev \
    zlib-dev \
    libc-dev \
    gcc \
    g++ \
    autoconf \
    && docker-php-ext-install bcmath \
    && docker-php-source delete \
    && apk del --no-cache \
    perl \
    dpkg-dev \
    dpkg \
    file \
    pkgconf \
    re2c

RUN apk del make musl-dev libc-dev gcc g++ autoconf bash

# Set Timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html

COPY ./api .
COPY --from=frontend /app/dist/ ./public/
COPY .setup/php/8.2/php.ini /usr/local/etc/php/conf.d/app.ini
COPY .setup/php/8.2/php-fpm-www.conf /usr/local/etc/php-fpm.d/www.conf
COPY .setup/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

## NGINX
RUN rm -f /etc/nginx/conf.d/*
COPY .setup/nginx/nginx.conf /etc/nginx/nginx.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --no-interaction --optimize-autoloader

EXPOSE 80

COPY .setup/entrypoint.sh .setup/entrypoint.sh
RUN chmod +x .setup/entrypoint.sh
ENTRYPOINT [".setup/entrypoint.sh"]
