#!/bin/bash

# Run Laravel migration and seeder gracefully
if ! php artisan migrate --force; then
    echo "Migration failed, proceeding without stopping the container..."
fi

if ! php artisan db:seed --force; then
    echo "Seeding failed, proceeding without stopping the container..."
fi

# Clear the cache, routes, config, and views
php artisan route:clear && php artisan config:clear && php artisan cache:clear && php artisan view:clear

# Start Supervisor to manage background processes
#echo "Starting Supervisor..."
#exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf

exec php artisan serve --host=0.0.0.0 --port="${PORT}"
