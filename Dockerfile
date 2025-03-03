# Base image
FROM php:8.2-apache

USER root

# Install dependencies
RUN apt-get update && \
    apt-get install -y --no-install-recommends openvpn curl apache2 libapache2-mod-php supervisor \
    libpq-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql \
    && pecl install mailparse \
    && docker-php-ext-enable mailparse \
    # gd
    && apt-get install -y build-essential nginx openssl libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev libicu-dev gcc g++ make nano jpegoptim optipng pngquant gifsicle locales libonig-dev libgmp-dev \
    && docker-php-ext-configure gd  \
    && docker-php-ext-install gd \
    # opcache
    && docker-php-ext-enable opcache \
    && docker-php-ext-install gmp pdo mbstring exif sockets pcntl bcmath \
    # khusus ci
    && docker-php-ext-install pdo_mysql mysqli zip intl

# Copy OpenVPN configuration and auth file
COPY vpn-config.ovpn /etc/openvpn/vpn-config.ovpn
COPY vpn-auth.txt /etc/openvpn/vpn-auth.txt

# Copy CI4 application
WORKDIR /var/www/html
COPY . .

# Set permissions for CI4
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/writable && chmod -R 775 /var/www/html/public

# Configure Apache to serve CI4
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite ssl # Enable SSL module

COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Configure supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord"]