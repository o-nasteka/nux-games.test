#!/bin/bash

# Fix permissions for database
if [ -f "/var/www/database/database.sqlite" ]; then
    chmod 777 /var/www/database/database.sqlite
fi
chmod -R 777 /var/www/database

# Fix permissions for storage and cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Continue with the default command
exec "$@"
