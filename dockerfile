FROM php:8.2-apache
RUN apt-get update && apt-get install -y unzip curl
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash -
RUN apt-get install -y nodejs
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
EXPOSE 80

CMD ["docker-entrypoint.sh"]
