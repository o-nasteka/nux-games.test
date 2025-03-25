#!/bin/bash

echo "🚀 Starting container setup..."

# Permissions
echo "🔧 Fixing permissions..."
if [ -f "/var/www/database/database.sqlite" ]; then
    echo "➡️  Setting chmod for database.sqlite"
    chmod 777 /var/www/database/database.sqlite
fi
chmod -R 777 /var/www/database
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Laravel setup
echo "📦 Running composer install..."
if [ ! -d "/var/www/vendor" ]; then
    composer install
else
    echo "✅ Vendor folder already exists, skipping composer install"
fi

echo "🔐 Generating app key..."
php artisan key:generate

echo "🗃 Running migrations..."
php artisan migrate --force

echo "🔗 Creating storage symlink..."
php artisan storage:link

# Frontend build
echo "📦 Installing frontend dependencies..."
if [ ! -d "/var/www/node_modules" ]; then
    npm install
else
    echo "✅ node_modules already exists, skipping npm install"
fi

echo "🛠 Building frontend assets..."
npm run build

echo "✅ Setup complete. Starting PHP-FPM..."

# Run the main container command
exec "$@"
