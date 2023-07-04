#!/bin/bash

# Start php-fpm in background
php-fpm &

# Replace the nginx config using the PORT environment variable
envsubst '${PORT}' < /etc/nginx/sites-available/default > /etc/nginx/sites-available/default

# Start nginx in foreground
nginx -g "daemon off;"