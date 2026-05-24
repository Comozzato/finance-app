FROM php:8.5-fpm-alpine3.23

RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    git \
    unzip \
    zip

# 2. Agora sim, o PHP tem tudo que precisa para compilar as extensões
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    intl

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

