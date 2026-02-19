#!/bin/bash

echo "Starting deployment..."

# Wait for database to be ready
echo "Waiting for database connection..."
until php artisan db:show 2>/dev/null; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "Database is ready!"

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear and cache config
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "Starting web server..."
php -d variables_order=EGPCS artisan serve --host=0.0.0.0 --port=$PORT
