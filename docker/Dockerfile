# Stage 1 - Composer Dependencies
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

COPY . .

RUN composer install \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction


RUN composer dump-autoload --optimize


# Stage 2 - Frontend Build
FROM node:24-alpine AS frontend

WORKDIR /app

COPY package*.json ./

RUN npm ci

COPY . .

RUN npm run build


# Stage 3 - Runtime
FROM php:8.5-fpm

WORKDIR /var/www/html


RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    unzip \
    curl \
    git \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*


# Laravel PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        gd \
        pdo_mysql \
        bcmath \
        intl \
        zip


COPY . .


COPY --from=vendor /app/vendor ./vendor

COPY --from=frontend /app/public/build ./public/build


COPY docker/nginx/default.conf \
    /etc/nginx/sites-available/default


COPY docker/supervisor/supervisord.conf \
    /etc/supervisor/conf.d/supervisord.conf


RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache


EXPOSE 80


COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh


ENTRYPOINT ["entrypoint.sh"]