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

if [ -f /etc/secrets/tidb-ca.pem ]; then

    echo "TiDB certificate found"

    # Make sure mounted certificate is readable by PHP-FPM/www-data
    chmod 644 /etc/secrets/tidb-ca.pem

    # Copy certificate inside Laravel storage for persistence/debugging
    cp /etc/secrets/tidb-ca.pem storage/certs/tidb-ca.pem

    chown www-data:www-data storage/certs/tidb-ca.pem

    chmod 644 storage/certs/tidb-ca.pem

    echo "TiDB certificate ready"

else

    echo "ERROR: TiDB certificate not found"

    exit 1

fi

echo "Building Laravel cache..."

php artisan optimize:clear

php artisan config:cache

php artisan route:cache

php artisan view:cache

php artisan event:cache

echo "Creating storage link..."

php artisan storage:link || true

APP_ROLE="${APP_ROLE:-web}"

echo "Application role: ${APP_ROLE}"

echo "Container started with role ${APP_ROLE}"

case "${APP_ROLE}" in

    web)

        echo "Starting Web..."

        exec /usr/bin/supervisord \
            -c /etc/supervisor/conf.d/supervisord.conf

        ;;

    worker)

        echo "Starting Queue Worker..."

        exec php artisan queue:work \
            redis \
            --queue=default \
            --sleep=3 \
            --tries=5 \
            --timeout=120 \
            --memory=256 \
            --max-time=3600

        ;;

    scheduler)

        echo "Starting Scheduler..."

        exec php artisan schedule:work --verbose

        ;;

    *)

        echo "Unknown APP_ROLE: ${APP_ROLE}"

        exit 1

        ;;

esac
