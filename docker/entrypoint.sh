#!/bin/bash

set -e

echo "Starting Laravel..."

cd /var/www/html

echo "Preparing runtime directories..."

mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/certs \
    bootstrap/cache

echo "Applying permissions..."

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "Preparing TiDB certificate..."

if [ -e /etc/secrets/tidb-ca.pem ]; then

    cp /etc/secrets/tidb-ca.pem storage/certs/tidb-ca.pem

    chown www-data:www-data storage/certs/tidb-ca.pem
    chmod 640 storage/certs/tidb-ca.pem

    echo "TiDB certificate ready"

else
    echo "WARNING: TiDB certificate not found"
fi

echo "Building Laravel cache..."

php artisan optimize:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

php artisan storage:link || true

echo "Application role: ${APP_ROLE:-web}"

case "${APP_ROLE:-web}" in

    web)
        exec /usr/bin/supervisord \
            -c /etc/supervisor/conf.d/supervisord.conf
        ;;

    worker)
        exec php artisan queue:work \
            --queue=default \
            --sleep=3 \
            --tries=3 \
            --timeout=90
        ;;

    scheduler)
        while true; do
            php artisan schedule:run
            sleep 60
        done
        ;;

    *)
        echo "Unknown APP_ROLE: $APP_ROLE"
        exit 1
        ;;

esac
