FROM php:8.0-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    libsqlite3-dev \
    libxml2-dev \
    libssl-dev \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_sqlite zip bcmath ctype fileinfo json mbstring openssl tokenizer xml

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
