FROM php:8.4-cli

# install system packages
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl nodejs npm libpq-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy project files
COPY . .

# remove Vite hot file (prevents dev-mode asset loading in production)
RUN rm -f public/hot

# install PHP dependencies (no dev, optimized autoloader)
RUN composer install --no-dev --optimize-autoloader

# install Node dependencies and build frontend assets
RUN npm ci && npm run build

# set permissions for Laravel storage and cache
RUN chmod -R 775 storage bootstrap/cache

# startup: cache config/routes/views, create storage symlink, run migrations, start server
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan storage:link && \
    php artisan migrate --force && \
    php -S 0.0.0.0:$PORT -t public
