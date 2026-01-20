#!/bin/sh
# Cache config Laravel saat container nyala
php artisan config:cache
php artisan route:cache

# Jalankan Nginx dan PHP-FPM bersamaan
nginx && php-fpm
