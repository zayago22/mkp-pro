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

# Write APP_KEY from Coolify env into .env file
if [ -n "$APP_KEY" ]; then
    sed -i "s|^APP_KEY=.*|APP_KEY=$APP_KEY|" /app/.env
fi

# Write APP_ENV from Coolify env into .env file
if [ -n "$APP_ENV" ]; then
    sed -i "s|^APP_ENV=.*|APP_ENV=$APP_ENV|" /app/.env
fi

# Write APP_DEBUG from Coolify env into .env file
if [ -n "$APP_DEBUG" ]; then
    sed -i "s|^APP_DEBUG=.*|APP_DEBUG=$APP_DEBUG|" /app/.env
fi

# Write APP_URL from Coolify env into .env file
if [ -n "$APP_URL" ]; then
    sed -i "s|^APP_URL=.*|APP_URL=$APP_URL|" /app/.env
else
    # Default to localhost if not set to avoid malformed host errors
    sed -i "s|^APP_URL=.*|APP_URL=http://localhost:8080|" /app/.env
fi

# Create fresh SQLite database
rm -f /app/database/database.sqlite
touch /app/database/database.sqlite
chmod 664 /app/database/database.sqlite

# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Create storage link (ignore if exists)
php artisan storage:link 2>/dev/null || true

# Clear any stale cache and re-cache
php artisan optimize:clear
php artisan optimize

echo "=== App ready ==="
echo "APP_KEY is set: $([ -n "$APP_KEY" ] && echo 'YES' || echo 'NO')"
echo "APP_ENV: $APP_ENV"
echo "APP_DEBUG: $APP_DEBUG"

# Start server
exec php artisan serve --host=0.0.0.0 --port=8080
EOF
RUN chmod +x /app/entrypoint.sh

# Keep .env as fallback defaults (Coolify env vars override at runtime)

EXPOSE 8080

CMD ["/app/entrypoint.sh"]
