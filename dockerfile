FROM richarvey/nginx-php-fpm:3.1.6

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Configure le port
ENV PORT=10000
EXPOSE ${PORT}

ENV RUN_SCRIPTS=1
ENV SCRIPT_DEBUG=1
