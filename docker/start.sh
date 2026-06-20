#!/bin/bash

# Generate app key if not set
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link
php artisan storage:link

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g "daemon off;"