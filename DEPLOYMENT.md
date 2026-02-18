# Guía de Despliegue en VPS - Mobile Kitchen Pro

## Requisitos del VPS

### Sistema Operativo recomendado
- **Ubuntu 22.04 LTS** o **Ubuntu 24.04 LTS** (más común y con mejor soporte)

### Especificaciones mínimas del VPS
- **RAM:** 1 GB (2 GB recomendado)
- **CPU:** 1 vCPU
- **Disco:** 20 GB SSD
- **Proveedores populares:** DigitalOcean, Vultr, Hetzner, Linode, Contabo

### Software necesario en el VPS
- PHP 8.2+ (con extensiones)
- Composer
- Node.js 18+ y npm
- Nginx (servidor web)
- SQLite3 o MySQL/PostgreSQL
- Git
- Certbot (para SSL gratuito con Let's Encrypt)

---

## Paso 1: Conectarte al VPS

Desde tu terminal (PowerShell o CMD):
```bash
ssh root@TU_IP_DEL_VPS
```

---

## Paso 2: Actualizar el sistema

```bash
apt update && apt upgrade -y
```

---

## Paso 3: Instalar PHP 8.3 y extensiones

```bash
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update

apt install -y php8.3 php8.3-fpm php8.3-cli php8.3-common \
  php8.3-mysql php8.3-sqlite3 php8.3-zip php8.3-gd php8.3-mbstring \
  php8.3-curl php8.3-xml php8.3-bcmath php8.3-intl php8.3-readline \
  php8.3-tokenizer php8.3-fileinfo
```

---

## Paso 4: Instalar Composer

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer --version
```

---

## Paso 5: Instalar Node.js 20 LTS

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs
node --version
npm --version
```

---

## Paso 6: Instalar Nginx

```bash
apt install -y nginx
systemctl enable nginx
systemctl start nginx
```

---

## Paso 7: Instalar Git y SQLite

```bash
apt install -y git sqlite3
```

---

## Paso 8: Crear usuario para la aplicación

```bash
adduser mkpro
usermod -aG www-data mkpro
```

---

## Paso 9: Clonar el proyecto desde GitHub

```bash
cd /var/www
git clone https://github.com/zayago22/mkp-pro.git
chown -R mkpro:www-data mkp-pro
cd mkp-pro
```

---

## Paso 10: Instalar dependencias

```bash
composer install --optimize-autoloader --no-dev
npm ci
npm run build
```

---

## Paso 11: Configurar el archivo .env

```bash
cp .env.example .env
nano .env
```

Edita con estos valores (cambia `tudominio.com` por tu dominio real):

```env
APP_NAME="Mobile Kitchen Pro"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

DB_CONNECTION=sqlite
# DB_DATABASE se usa automáticamente como database/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hola@rekobit.com
MAIL_PASSWORD=qtgu ssfm qbpp jaec
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hola@rekobit.com
MAIL_FROM_NAME="Mobile Kitchen Pro"
```

Guarda con `Ctrl+O`, Enter, `Ctrl+X`.

---

## Paso 12: Generar clave y preparar la base de datos

```bash
php artisan key:generate
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

---

## Paso 13: Permisos correctos

```bash
chown -R mkpro:www-data /var/www/mkp-pro
chmod -R 775 storage bootstrap/cache
chmod 664 database/database.sqlite
```

---

## Paso 14: Configurar Nginx

Crea el archivo de configuración:

```bash
nano /etc/nginx/sites-available/mkp-pro
```

Pega este contenido (cambia `tudominio.com` por tu dominio):

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name tudominio.com www.tudominio.com;
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
```

Activa el sitio:

```bash
ln -s /etc/nginx/sites-available/mkp-pro /etc/nginx/sites-enabled/
rm /etc/nginx/sites-enabled/default
nginx -t
systemctl reload nginx
```

---

## Paso 15: SSL gratuito con Let's Encrypt

```bash
apt install -y certbot python3-certbot-nginx
certbot --nginx -d tudominio.com -d www.tudominio.com
```

Sigue las instrucciones (pide un email y aceptar términos). El certificado se renueva automáticamente.

---

## Paso 16: Optimizar Laravel para producción

```bash
cd /var/www/mkp-pro
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Paso 17: Crear el usuario admin

```bash
php artisan tinker
```

Dentro de tinker:
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'contacto@mobilkitchenpro.com',
    'password' => bcrypt('Clave2230!')
]);
exit
```

---

## Resumen: Antes de comprar el VPS necesitas

| Elemento | Detalle |
|----------|---------|
| **VPS** | Ubuntu 22.04/24.04, 1GB RAM, 20GB SSD (~$5-10/mes) |
| **Dominio** | Un dominio apuntando al IP del VPS (DNS tipo A) |
| **Acceso SSH** | Para conectarte al servidor |
| **Proveedor recomendado** | DigitalOcean, Vultr, Hetzner o Contabo |

## Checklist rápido

- [ ] Comprar/rentar VPS
- [ ] Apuntar dominio al IP del VPS (registro DNS tipo A)
- [ ] Conectarte por SSH
- [ ] Instalar PHP, Composer, Node, Nginx, Git, SQLite
- [ ] Clonar el repo desde GitHub
- [ ] Instalar dependencias (composer + npm)
- [ ] Compilar assets (npm run build)
- [ ] Configurar .env
- [ ] Migrar base de datos
- [ ] Configurar Nginx
- [ ] Instalar SSL con Certbot
- [ ] Optimizar Laravel
- [ ] Crear usuario admin
- [ ] Probar el sitio

---

## Actualizar el sitio después de cambios

Cuando hagas cambios en el código y los subas a GitHub:

```bash
cd /var/www/mkp-pro
git pull origin main
composer install --optimize-autoloader --no-dev
npm ci && npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan optimize
sudo systemctl reload php8.3-fpm
```
