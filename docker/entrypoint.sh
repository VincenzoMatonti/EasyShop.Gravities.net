#!/bin/bash

set -e

echo "Starting Laravel..."

cd /var/www/html


echo "Preparing Laravel directories..."

mkdir -p \
    storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/certs \
    bootstrap/cache


echo "Applying Laravel permissions..."

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache


echo "Preparing TiDB CA certificate..."

if [ -e /etc/secrets/tidb-ca.pem ]; then
    echo "TiDB CA certificate found"

    cp /etc/secrets/tidb-ca.pem storage/certs/tidb-ca.pem

    chown www-data:www-data storage/certs/tidb-ca.pem
    chmod 640 storage/certs/tidb-ca.pem

    echo "Runtime TiDB CA certificate:"
    ls -la storage/certs/tidb-ca.pem
else
    echo "WARNING: TiDB CA certificate missing"
fi


echo "Clearing Laravel cache..."

php artisan config:clear || true
php artisan optimize:clear


echo "Building Laravel cache..."

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache


php artisan storage:link || true


echo "Checking DB as www-data..."

su -s /bin/bash www-data -c "
php artisan tinker --execute=\"
echo config('database.connections.mysql.host');
echo PHP_EOL;
DB::connection()->getPdo();
echo 'DB OK';
\"
"


echo "Laravel ready"


exec /usr/bin/supervisord \
    -c /etc/supervisor/conf.d/supervisord.conf