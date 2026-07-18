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


# Clear old cache
php artisan optimize:clear

# Build production cache
php artisan config:cache
php artisan route:cache
php artisan view:cache


# Storage
php artisan storage:link || true

echo "Checking DB..."

php artisan tinker --execute="echo config('database.connections.mysql.host');DB::connection()->getPdo();echo ' DB OK';"

echo "Laravel ready"

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf