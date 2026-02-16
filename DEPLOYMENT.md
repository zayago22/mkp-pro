# Guía de despliegue - Mobile Kitchen Pro

## Pasos para poner en producción

### 1. Configuración del servidor
- PHP 8.2+
- Composer
- Node.js 18+ y npm
- MySQL/PostgreSQL (opcional, para proyectos y testimonials)

### 2. Instalación
```bash
composer install --optimize-autoloader --no-dev
npm ci
npm run build
```

### 3. Base de datos (opcional)
Si quieres proyectos y testimonials dinámicos desde la base de datos:
```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link   # Enlace para subir imágenes de proyectos
```

### 4. Variables de entorno (.env)
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Correo - formulario de contacto
MAIL_MAILER=smtp
MAIL_HOST=tu-servidor-smtp
MAIL_PORT=587
MAIL_USERNAME=tu-email
MAIL_PASSWORD=tu-password
MAIL_FROM_ADDRESS=noreply@tudominio.com
MAIL_FROM_NAME="Mobile Kitchen Pro"
MAIL_CONTACT_TO=info@tudominio.com
```

### 5. Optimización
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Imágenes propias
- **Hero slider**: Coloca 4 imágenes en `public/images/hero/` como `hero-1.jpg`, `hero-2.jpg`, `hero-3.jpg`, `hero-4.jpg`
- **Proyectos**: Coloca imágenes en `public/images/projects/` (project-1.jpg, etc.) o configura en la base de datos

### 7. Sitemap
El sitemap está disponible en: `https://tudominio.com/sitemap.xml`

Add a `<link rel="sitemap" href="/sitemap.xml">` en el `<head>` si lo deseas.
