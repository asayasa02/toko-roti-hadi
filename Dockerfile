FROM php:8.2-apache

# Install dependency system + extension PHP yang dibutuhkan CI4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl mbstring pdo pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Apache modules
RUN a2enmod rewrite \
    && a2dismod mpm_event || true \
    && a2dismod mpm_worker || true \
    && a2enmod mpm_prefork

# Workdir
WORKDIR /var/www/html

# Copy project
COPY . .

# Install dependency PHP
RUN composer install --no-dev --optimize-autoloader

# Set document root ke folder public CI4
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

# Script start untuk Railway PORT dinamis
RUN printf '#!/bin/sh\n\
set -e\n\
PORT=${PORT:-8080}\n\
sed -ri "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf\n\
sed -ri "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf\n\
apache2-foreground\n' > /usr/local/bin/start-railway.sh \
    && chmod +x /usr/local/bin/start-railway.sh

EXPOSE 8080

CMD ["/usr/local/bin/start-railway.sh"]