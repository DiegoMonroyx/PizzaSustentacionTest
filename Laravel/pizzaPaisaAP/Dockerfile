# Imagen base con PHP 8.2 y extensiones recomendadas
FROM php:8.1-cli

# Instala dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    build-essential\
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip\
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos del proyecto al contenedor
COPY . .

# Instala las dependencias de Composer
RUN composer install 

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expone el puerto 8000 para el servidor de Laravel
EXPOSE 8000

# Comando por defecto para iniciar el servidor de desarrollo

CMD ["php", "artisan", "serve","--host=0.0.0.0", "--port=8000"]