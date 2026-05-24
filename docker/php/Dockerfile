FROM php:8.5-fpm-alpine3.23


RUN apk add --no-cache \
    pcre-dev \
    $PHPIZE_DEPS \
    libpq-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    git \
    unzip \
    zip \
    nodejs \
    npm


# 2. Agora sim, o PHP tem tudo que precisa para compilar as extensões
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    intl \
    pcntl

RUN pecl install redis && docker-php-ext-enable redis
# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

