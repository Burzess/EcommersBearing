# --- STAGE 1: Build Assets (Frontend) ---
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
# Gunakan npm install agar lebih stabil
RUN npm install --ignore-scripts
COPY . .
# Jalankan build jika ada scriptnya
RUN npm run build --if-present || echo "Frontend build skipped"

# --- STAGE 2: Build Vendor (Composer) ---
# FIX: Gunakan 'latest' agar support PHP versi terbaru
FROM composer:latest AS vendor
WORKDIR /app
COPY composer.json composer.lock ./

# FIX CRITICAL: Tambahkan '--no-scripts'
# Ini mencegah Composer menjalankan 'php artisan package:discover' yang sering error di docker build
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader --no-scripts

# --- STAGE 3: Production Image (PHP 8.4) ---
FROM php:8.4-fpm-alpine

# Install System Dependencies
RUN apk add --no-cache nginx libpng-dev libzip-dev zip unzip curl

# Install PHP Extensions
RUN docker-php-ext-install pdo_mysql bcmath gd zip opcache

# Copy Config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

# Copy Vendor dari Stage 2
COPY --from=vendor /app/vendor ./vendor

# Buat folder build & Copy Frontend
RUN mkdir -p public/build
COPY --from=frontend /app/public/build ./public/build

# Copy Source Code
COPY . .

# Permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
