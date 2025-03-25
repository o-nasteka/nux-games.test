# nux-games.test

## Preview

![App screenshot](screenshot.png)

## Requirements

- Docker
- Docker Compose
- Git

---

## Step 1: Clone the repository

```bash
git clone https://github.com/o-nasteka/nux-games.test.git
cd nux-games.test
```

---

## Step 2: Configure `.env` files

### 2.1 Laravel `.env`

```bash
cp .env.example .env
```

> Make sure `DB_CONNECTION=sqlite`  
> And that the file `database/database.sqlite` exists (or create it manually)

---

### 2.2 Docker `.env`

```bash
cp docker/.env.example docker/.env
```

> Required for correct project volume mounting in the container

---

## Step 3: Build and Run Docker containers

```bash
cd docker
docker compose up -d --build
```

---

## Step 4: Set up Laravel

```bash
docker compose exec app bash
```

Inside the container, run:

```bash
composer install &&
php artisan key:generate &&
php artisan migrate &&
php artisan storage:link &&
npm install &&
npm run build &&
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

---

## Step 5: Access the application

Open [http://localhost](http://localhost) in your browser.

---

## Troubleshooting

### SQLite: "attempt to write a readonly database"

If you see the error:

```
SQLSTATE[HY000]: General error: 8 attempt to write a readonly database
```

This means Laravel inside the container does not have write access to the SQLite database file.

#### Solution:

1. From your host machine, run:

```bash
chmod 777 database/database.sqlite
chmod -R 777 database/
```

2. If the file does not exist, create it:

```bash
touch database/database.sqlite
chmod 777 database/database.sqlite
```

3. Alternatively, inside the container:

```bash
docker compose exec app bash
chown -R www-data:www-data /var/www/database
chmod -R 777 /var/www/database
```

After this, refresh the page in your browser — the error should be gone.

