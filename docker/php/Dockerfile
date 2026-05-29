FROM dunglas/frankenphp:1-php8.5-alpine

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

# Extensões PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    intl \
    pcntl

RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
