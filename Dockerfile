# Étape 1 : Build avec PHP CLI (Debian) + composer + node
FROM php:8.2-cli AS build

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Installer composer manuellement
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Étape 2 : Image finale avec PHP + Apache
FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=build /app /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
