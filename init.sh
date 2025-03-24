#!/bin/bash
echo "Setting up the project..."

# Create SQLite database file if it does not exist
if [ ! -f "./database/database.sqlite" ]; then
  touch ./database/database.sqlite
fi

# Start Docker containers
cd docker
docker-compose up -d

# Set up Laravel
docker-compose exec app bash -c "cd /var/www &&
composer install &&
php artisan key:generate &&
php artisan migrate --seed &&
php artisan storage:link &&
npm install &&
npm run build &&
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache"

echo "Done! Open http://localhost in your browser."
