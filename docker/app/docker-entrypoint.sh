#!/bin/bash

# Permissions
if [ -f "/var/www/database/database.sqlite" ]; then
    chmod 777 /var/www/database/database.sqlite
fi
chmod -R 777 /var/www/database
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Laravel setup
if [ ! -d "/var/www/vendor" ]; then
    composer install
fi

php artisan key:generate
php artisan migrate --force
php artisan storage:link

# Frontend build
if [ ! -d "/var/www/node_modules" ]; then
    npm install
fi

npm run build

# Run the main container command
exec "$@"
