#!/bin/bash

set -e

echo "Starting Laravel..."

cd /var/www/html


# Laravel directories
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache


# Permissions
chown -R www-data:www-data storage bootstrap/cache


# Clear old cache
php artisan config:clear || true

echo "MYSQL_ATTR_SSL_CA=$MYSQL_ATTR_SSL_CA"

if [ -f "$MYSQL_ATTR_SSL_CA" ]; then
    echo "CA file found"
else
    echo "CA file NOT found"
fi

# Build production cache
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true


# Storage
php artisan storage:link || true


echo "Laravel ready"


exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf