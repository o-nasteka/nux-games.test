# nux-games.com

## Requirements

- Docker
- Docker Compose
- Git

## Step 1: Clone the repository

```bash
git clone https://github.com/o-nasteka/nux-games.com.git
cd nux-games.com
```

## Step 2: Configure .env files

### Configure .env for the Laravel application

```bash
cp .env.example .env
```

The database is set to SQLite by default. No additional database configuration is needed.

## Step 3: Build and Run Docker containers

```bash
cd docker
docker-compose up -d
```

## Step 4: Set up Laravel

```bash
docker-compose exec app bash
```

Then, inside the container, run the following commands:

```bash
cd /var/www
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install
npm run build
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

## Step 5: Access the application

Open [http://localhost](http://localhost) in your browser.

## Step 6: Troubleshooting

If something went wrong, use these commands:

```bash
docker-compose exec app bash
```

Then, inside the container, run the following commands:

```bash
cd /var/www
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install
npm run build
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```
