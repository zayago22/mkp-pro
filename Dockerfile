FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl zip unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libsqlite3-dev libicu-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mbstring xml bcmath gd zip intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for caching
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Copy package files and build assets
COPY package.json package-lock.json ./
RUN npm ci

# Copy the rest of the application
COPY . .

# Run composer scripts after full copy
RUN composer dump-autoload --optimize

# Build frontend assets
RUN npm run build

# Setup Laravel
RUN php artisan key:generate --force \
    && mkdir -p database storage/app/public storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && touch database/database.sqlite \
    && php artisan migrate --force \
    && php artisan storage:link || true \
    && php artisan optimize \
    && chmod -R 775 storage bootstrap/cache \
    && chmod 664 database/database.sqlite

EXPOSE 8080

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
