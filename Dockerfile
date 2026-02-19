FROM php:8.4-cli

# install packages
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl nodejs npm \
    && docker-php-ext-install zip pdo pdo_mysql

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy project
COPY . .

# remove the Vite hot file if it exists (prevents dev-mode asset loading in production)
RUN rm -f public/hot

# install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# install Node dependencies and build frontend assets
RUN npm ci && npm run build

# permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache

# cache config/routes/views (uses env vars injected at runtime, not build time)
# We skip artisan caches at build time since DB env vars aren't available during build

# start server
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php -S 0.0.0.0:$PORT -t public
