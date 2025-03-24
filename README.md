# nux-games.test

## Requirements

- Docker
- Docker Compose
- Git

## Step 1: Clone the repository

```bash
git clone https://github.com/o-nasteka/nux-games.test.git
cd nux-games.test
```

## Step 2: Configure .env files

### Configure .env for the Laravel application

```bash
cp .env.example .env
```

The database is set to SQLite by default. No additional database configuration is needed.

## Step 3: Run Docker containers

```bash
./init.sh
```

## Step 4: Access the application

Open [http://localhost](http://localhost) in your browser.

## Step 5: Troubleshooting

If something went wrong, use this command:

```bash
docker-compose exec app bash -c "cd /var/www &&
composer install &&
php artisan key:generate &&
php artisan migrate &&
php artisan storage:link &&
npm install &&
npm run build &&
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache"
```
