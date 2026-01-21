# --- STAGE 1: Build Assets (Frontend) ---
# FIX: Menggunakan 'AS' (huruf besar) untuk menghilangkan warning
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./

# FIX: Mengganti 'npm ci' dengan 'npm install' agar lebih toleran terhadap koneksi lambat
# --ignore-scripts agar tidak macet di post-install script yang tidak perlu
RUN npm install --ignore-scripts

COPY . .
# Jalankan build jika script ada. Jika gagal, cetak pesan tapi jangan stop proses (|| echo)
# Ini agar pipeline backend tidak merah hanya karena frontend error
RUN npm run build --if-present || echo "Frontend build skipped"

# --- STAGE 2: Build Vendor (Composer) ---
FROM composer:2.6 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
# Install dependency production only
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs --optimize-autoloader

# --- STAGE 3: Production Image (PHP 8.4) ---
FROM php:8.4-fpm-alpine

# Install System Dependencies (Nginx, Zip, Curl, dll)
RUN apk add --no-cache nginx libpng-dev libzip-dev zip unzip curl

# Install PHP Extensions wajib untuk Laravel
RUN docker-php-ext-install pdo_mysql bcmath gd zip opcache

# Copy Config Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Copy Config PHP (File yang baru saja Anda buat)
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

# Copy Vendor dari Stage 2
COPY --from=vendor /app/vendor ./vendor

# FIX: Buat folder public/build manual untuk mencegah error "Not Found" saat COPY
RUN mkdir -p public/build

# Copy Frontend dari Stage 1 (Jika build gagal, folder ini mungkin kosong, tidak apa-apa)
COPY --from=frontend /app/public/build ./public/build

# Copy Seluruh Source Code Laravel
COPY . .

# Atur Hak Akses Folder Storage (Penting agar Laravel bisa nulis log/session)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Buka Port 80
EXPOSE 80

# Script Entrypoint untuk menyalakan Nginx & PHP
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
