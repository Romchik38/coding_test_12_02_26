FROM php:8.4-fpm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       zlib1g-dev libzip-dev libpq-dev libicu-dev git unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) pdo pdo_pgsql intl zip opcache \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /srv/app

CMD ["php-fpm"]
