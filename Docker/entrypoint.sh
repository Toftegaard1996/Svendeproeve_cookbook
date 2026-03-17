#!/usr/bin/env bash

set -e

role=${1:-app}
env=${APP_ENV:-production}

if [ "$env" != "local" ]; then
    echo "Caching configuration..."
    (php artisan config:cache && php artisan view:cache && php artisan storage:link)
fi

if [ "$role" = "app" ]; then

    exec apache2-foreground

elif [ "$role" = "queue-worker" ]; then

    echo "Running the queue..."
    php /app/artisan queue:work --verbose --tries=3 --timeout=90

elif [ "$role" = "scheduler" ]; then

    echo "Running the scheduler..."
    while [ true ]
    do
      php /app/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done

elif [ "$role" = "migrate" ]; then

    echo "Running migrations..."
    php /app/artisan migrate:digitalocean

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
