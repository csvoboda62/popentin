FROM php:8.4-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    opcache

# Copier la configuration PHP personnalisée
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers composer
COPY composer.json composer.lock symfony.lock ./

# Installer les dépendances PHP
RUN composer install --no-scripts --no-autoloader --prefer-dist

# Copier le reste de l'application
COPY . .

# Optimiser l'autoloader
RUN composer dump-autoload --optimize

# Créer les répertoires nécessaires s'ils n'existent pas
RUN mkdir -p var/cache var/log public/uploads

# Configurer git pour éviter les avertissements de propriété
RUN git config --global --add safe.directory /var/www/html

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 9000
EXPOSE 9000

CMD ["php-fpm"]






