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
    ca-certificates \
    openssl \
    nginx \
    supervisor \
    unzip \
    curl \
    git \
    procps \
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


# Redis PHP extension
RUN apt-get update && apt-get install -y \
    libz-dev \
    && pecl channel-update pecl.php.net \
    && pecl install redis \
    && docker-php-ext-enable redis

# PHP-FPM explicit runtime user
RUN sed -i 's/^user = .*/user = www-data/' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/^group = .*/group = www-data/' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/^listen.owner = .*/listen.owner = www-data/' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/^listen.group = .*/listen.group = www-data/' /usr/local/etc/php-fpm.d/www.conf

# Application
COPY --chown=www-data:www-data . .


COPY --from=vendor \
    --chown=www-data:www-data \
    /app/vendor ./vendor


COPY --from=frontend \
    --chown=www-data:www-data \
    /app/public/build ./public/build


RUN rm -f public/hot


COPY infra/docker/dev/nginx/default.conf \
    /etc/nginx/sites-available/default


COPY infra/docker/dev/supervisor/supervisord.conf \
    /etc/supervisor/conf.d/supervisord.conf


# Laravel writable folders
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN mkdir -p /var/www/.config/psysh \
    && chown -R www-data:www-data /var/www/.config


EXPOSE 80 443


COPY infra/docker/dev/entrypoint.sh /usr/local/bin/entrypoint.sh



RUN chmod +x /usr/local/bin/entrypoint.sh


ENTRYPOINT ["entrypoint.sh"]