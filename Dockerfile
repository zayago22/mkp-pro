FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl zip unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libsqlite3-dev libicu-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install bcmath gd zip intl \
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

# Create .env from example for build phase (Vite needs it)
RUN cp .env.example .env

# Run composer scripts after full copy
RUN composer dump-autoload --optimize

# Build frontend assets
RUN npm run build

# Create required directories and set permissions
RUN mkdir -p database storage/app/public storage/framework/sessions \
    storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache database

# Create entrypoint script for runtime initialization
COPY <<'EOF' /app/entrypoint.sh
#!/bin/bash
set -e

cd /app

# Create SQLite database if not exists
touch /app/database/database.sqlite
chmod 664 /app/database/database.sqlite

# Run migrations
php artisan migrate --force

# Seed database if empty (first run only)
php artisan db:seed --force 2>/dev/null || true

# Create storage link (ignore if exists)
php artisan storage:link 2>/dev/null || true

# Clear any stale cache and re-cache
php artisan optimize:clear
php artisan optimize

# Start server
exec php artisan serve --host=0.0.0.0 --port=8080
EOF
RUN chmod +x /app/entrypoint.sh

# Remove build-time .env (runtime env vars come from Coolify)
RUN rm -f .env

EXPOSE 8080

CMD ["/app/entrypoint.sh"]
