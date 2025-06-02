#!/bin/bash
echo "👉 Checking SQLite database exists"

if [ ! -f "/var/www/html/database/database.sqlite" ]; then
    echo "👉 Creating SQLite database"
    touch /var/www/html/database/database.sqlite
    php artisan migrate --force
fi
