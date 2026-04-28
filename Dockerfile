FROM php:8.2-apache

# Install dependencies (tambah libonig-dev untuk mbstring)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libonig-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-install \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    mbstring \
    xml \
    gd \
    && docker-php-ext-enable intl pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Apache config dengan dynamic PORT dari Railway
RUN echo '<VirtualHost *:${PORT}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
        Options -Indexes\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
RUN a2enmod rewrite

# Script untuk set PORT dinamis dari Railway
RUN echo '#!/bin/bash\n\
sed -i "s/\${PORT}/$PORT/g" /etc/apache2/sites-available/000-default.conf\n\
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf\n\
apache2-foreground' > /start.sh \
    && chmod +x /start.sh

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/writable

EXPOSE ${PORT:-80}

CMD ["/start.sh"]