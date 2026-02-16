#!/bin/bash
# ============================================
# Deploy Script - Mobile Kitchen Pro
# Ejecutar como root en Ubuntu 22.04/24.04
# ============================================

set -e

echo "=========================================="
echo "  INSTALANDO MKP PRO EN VPS"
echo "=========================================="

# --- PASO 1: Actualizar sistema ---
echo ""
echo "[1/12] Actualizando sistema..."
apt update && apt upgrade -y

# --- PASO 2: Instalar PHP 8.3 ---
echo ""
echo "[2/12] Instalando PHP 8.3..."
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y php8.3 php8.3-fpm php8.3-cli php8.3-common \
  php8.3-mysql php8.3-sqlite3 php8.3-zip php8.3-gd php8.3-mbstring \
  php8.3-curl php8.3-xml php8.3-bcmath php8.3-intl php8.3-readline \
  php8.3-tokenizer php8.3-fileinfo unzip

# --- PASO 3: Instalar Composer ---
echo ""
echo "[3/12] Instalando Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer --version

# --- PASO 4: Instalar Node.js 20 ---
echo ""
echo "[4/12] Instalando Node.js 20..."
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs
node --version
npm --version

# --- PASO 5: Instalar Nginx ---
echo ""
echo "[5/12] Instalando Nginx..."
apt install -y nginx
systemctl enable nginx
systemctl start nginx

# --- PASO 6: Instalar Git y SQLite ---
echo ""
echo "[6/12] Instalando Git y SQLite..."
apt install -y git sqlite3

# --- PASO 7: Clonar el proyecto ---
echo ""
echo "[7/12] Clonando proyecto desde GitHub..."
cd /var/www
if [ -d "mkp-pro" ]; then
    echo "El directorio mkp-pro ya existe, haciendo pull..."
    cd mkp-pro
    git pull origin main
else
    git clone https://github.com/zayago22/mkp-pro.git
    cd mkp-pro
fi

# --- PASO 8: Instalar dependencias ---
echo ""
echo "[8/12] Instalando dependencias PHP..."
composer install --optimize-autoloader --no-dev

echo ""
echo "[9/12] Instalando dependencias JS y compilando assets..."
npm ci
npm run build

# --- PASO 10: Configurar .env ---
echo ""
echo "[10/12] Configurando .env..."
cp .env.example .env
php artisan key:generate

sed -i 's|APP_ENV=local|APP_ENV=production|' .env
sed -i 's|APP_DEBUG=true|APP_DEBUG=false|' .env
sed -i 's|APP_URL=http://localhost|APP_URL=http://163.245.216.237|' .env
sed -i 's|DB_CONNECTION=mysql|DB_CONNECTION=sqlite|' .env
sed -i '/^DB_HOST/d' .env
sed -i '/^DB_PORT/d' .env
sed -i '/^DB_DATABASE=laravel/d' .env
sed -i '/^DB_USERNAME/d' .env
sed -i '/^DB_PASSWORD/d' .env

sed -i 's|MAIL_MAILER=log|MAIL_MAILER=smtp|' .env
sed -i 's|MAIL_HOST=127.0.0.1|MAIL_HOST=smtp.gmail.com|' .env
sed -i 's|MAIL_PORT=2525|MAIL_PORT=587|' .env
sed -i 's|MAIL_USERNAME=null|MAIL_USERNAME=hola@rekobit.com|' .env
sed -i 's|MAIL_PASSWORD=null|MAIL_PASSWORD="qtgu ssfm qbpp jaec"|' .env
sed -i 's|MAIL_ENCRYPTION=null|MAIL_ENCRYPTION=tls|' .env
sed -i 's|MAIL_FROM_ADDRESS="hello@example.com"|MAIL_FROM_ADDRESS="hola@rekobit.com"|' .env
sed -i 's|MAIL_FROM_NAME="${APP_NAME}"|MAIL_FROM_NAME="Mobile Kitchen Pro"|' .env

# --- PASO 11: Base de datos y migraciones ---
echo ""
echo "[11/12] Configurando base de datos..."
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

# Crear usuario admin
php artisan tinker --execute="
\App\Models\User::updateOrCreate(
    ['email' => 'contacto@mobilkitchenpro.com'],
    ['name' => 'Admin', 'password' => bcrypt('Clave2230!')]
);
echo 'Usuario admin creado.';
"

# --- PASO 12: Permisos ---
echo ""
echo "[12/12] Configurando permisos..."
chown -R www-data:www-data /var/www/mkp-pro
chmod -R 775 storage bootstrap/cache
chmod 664 database/database.sqlite

# --- Configurar Nginx ---
echo ""
echo "Configurando Nginx..."

cat > /etc/nginx/sites-available/mkp-pro << 'NGINXEOF'
server {
    listen 80;
    listen [::]:80;
    server_name 163.245.216.237;
    root /var/www/mkp-pro/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 20M;
}
NGINXEOF

ln -sf /etc/nginx/sites-available/mkp-pro /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

nginx -t
systemctl reload nginx

# --- Optimizar Laravel ---
echo ""
echo "Optimizando Laravel..."
cd /var/www/mkp-pro
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo ""
echo "=========================================="
echo "  INSTALACION COMPLETADA!"
echo "=========================================="
echo ""
echo "  Tu sitio esta en: http://163.245.216.237"
echo "  Admin: http://163.245.216.237/login"
echo "  Usuario: contacto@mobilkitchenpro.com"
echo "  Password: Clave2230!"
echo ""
echo "  Cuando tengas dominio, ejecuta:"
echo "  apt install -y certbot python3-certbot-nginx"
echo "  certbot --nginx -d tudominio.com"
echo ""
echo "=========================================="
