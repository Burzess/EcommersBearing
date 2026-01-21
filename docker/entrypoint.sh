#!/bin/sh

# Cache config Laravel saat container nyala
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Menggunakan --force agar tidak minta konfirmasi Yes/No di production
echo "Running database migrations..."
php artisan migrate --force

nginx && php-fpm
