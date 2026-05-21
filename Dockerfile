FROM composer:latest AS composer
FROM php:8.2-fpm

# Copia o Composer da imagem oficial
COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer

# Instala extensões necessárias incluindo GD
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE $PORT

CMD php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT