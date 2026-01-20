# --- STAGE 1: Build Assets (Frontend) ---
# Menggunakan Node.js untuk compile CSS/JS (Vite)
FROM node:20-alpine as frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
# Abaikan error vite build jika tidak ada script build, atau gunakan npm run build
RUN npm run build --if-present

# --- STAGE 2: Build Vendor (Composer) ---
FROM composer:2.6 as vendor
WORKDIR /app
COPY composer.json composer.lock ./
# Install hanya library production agar size kecil
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader

# --- STAGE 3: Production Image (PHP 8.4) ---
FROM php:8.4-fpm-alpine

# Install Nginx & Extension PHP yang dibutuhkan Laravel
RUN apk add --no-cache nginx libpng-dev libzip-dev zip unzip curl
RUN docker-php-ext-install pdo_mysql bcmath gd zip opcache

# Konfigurasi Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

# Copy hasil build dari Stage 1 & 2
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build
COPY . .

# Atur permission storage
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

# Script jalan otomatis
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
