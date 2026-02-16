FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip libzip-dev zip curl
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php -S 0.0.0.0:$PORT -t public
