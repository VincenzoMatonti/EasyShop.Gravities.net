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


# Build production cache
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true


# Storage
php artisan storage:link || true

mysql \
  --host="$DB_HOST" \
  --port="$DB_PORT" \
  --user="$DB_USERNAME" \
  --password="$DB_PASSWORD" \
  --ssl-ca="$MYSQL_ATTR_SSL_CA" \
  "$DB_DATABASE" \
  -e "SELECT VERSION();"

php artisan tinker --execute="DB::connection()->getPdo();"

echo "Laravel ready"


exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf