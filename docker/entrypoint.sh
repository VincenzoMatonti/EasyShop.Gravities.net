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
    bootstrap/cache


echo "Applying Laravel permissions..."

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache


echo "Checking Render TiDB certificate..."

if [ -e /etc/secrets/tidb-ca.pem ]; then
    echo "TiDB CA certificate found"
    ls -la /etc/secrets/tidb-ca.pem
else
    echo "WARNING: TiDB CA certificate missing"
fi


echo "Clearing Laravel cache..."

php artisan config:clear || true
php artisan optimize:clear


echo "Building Laravel cache..."

echo "MYSQL_ATTR_SSL_CA:"
echo "$MYSQL_ATTR_SSL_CA"

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

php artisan tinker --execute="
var_dump(config('database.connections.mysql.options'));
"

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