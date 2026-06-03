FROM php:8.2-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nginx \
    supervisor

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy Nginx config
RUN mkdir -p /etc/nginx/sites-enabled
COPY nginx.conf /etc/nginx/sites-enabled/default

# Copy supervisor config
COPY supervisor.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port
EXPOSE 10000

# Run deploy script and start services
CMD ["/bin/bash", "-c", "php artisan config:cache && php artisan route:cache && php artisan migrate --force && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf"]
