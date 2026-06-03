#!/bin/bash
set -e
# Génère le .env depuis les variables d'environnement Render
cat > /var/www/html/.env << EOF
APP_KEY="${APP_KEY}"
DB_HOST="${DB_HOST}"
SESSION_DRIVER=file
EOF
php artisan migrate --force
php artisan db:seed --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
apache2-foreground
