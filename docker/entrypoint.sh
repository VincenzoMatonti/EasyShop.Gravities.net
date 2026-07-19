#!/bin/bash

set -e

echo "Starting Laravel..."

cd /var/www/html


# Laravel directories
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache


# Laravel permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache


# Render mounted secrets permissions
if [ -f /etc/secrets/tidb-ca.pem ]; then
    chown root:www-data /etc/secrets/tidb-ca.pem
    chmod 640 /etc/secrets/tidb-ca.pem
fi

# Clear old cache
php artisan config:clear || true
php artisan optimize:clear

# Build production cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache


# Storage
php artisan storage:link || true

echo "Checking DB..."

php artisan tinker --execute="echo config('database.connections.mysql.host');DB::connection()->getPdo();echo ' DB OK';"

echo "Laravel ready"

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf