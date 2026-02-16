FROM php:8.4-cli

# install packages
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl \
    && docker-php-ext-install zip pdo pdo_mysql

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy project
COPY . .

# install dependencies
RUN composer install --no-dev --optimize-autoloader

# permissions for Laravel
RUN chmod -R 777 storage bootstrap/cache

# generate key if not exists
RUN php artisan key:generate || true

# cache
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# start server
CMD php -S 0.0.0.0:$PORT -t public
