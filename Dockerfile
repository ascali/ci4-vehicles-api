# Gunakan base image PHP 8.3
FROM php:8.3

# Set user root
USER root

# Argument untuk environment base64
ARG ENV_BASE64

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential nginx openssl \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev \
    libpq5 libpq-dev \
    libicu-dev \
    libgmp-dev \
    gcc g++ make vim zip unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev \
    libhiredis-dev \ 
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* /tmp/pear/*

# Instal ekstensi Redis menggunakan PECL
RUN pecl install redis \
    && docker-php-ext-enable redis

# Konfigurasi dan install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli mbstring exif sockets pcntl bcmath intl gmp \
    && docker-php-ext-enable opcache mysqli


# Copy project files
WORKDIR /var/www
COPY . /var/www

# Copy custom PHP configuration
COPY ./deploy/local.ini /usr/local/etc/php/php.ini

# Decode base64 environment file
RUN if [ -n "$ENV_BASE64" ]; then \
        echo -n "$ENV_BASE64" | base64 --decode > /var/www/.env; \
    else \
        echo "ENV_BASE64 is empty or not set"; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && find /var/www -type d -exec chmod 755 {} \; \
    && find /var/www -type f -exec chmod 644 {} \;

# Ensure writable directory has proper permissions
RUN chown -R www-data:www-data /var/www/writable \
    && chmod -R 775 /var/www/writable

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --prefer-dist --no-interaction --ignore-platform-reqs --no-dev -a \
    && composer dump-autoload

# Copy NGINX configuration
COPY deploy/nginx.conf /etc/nginx/nginx.conf

# Expose port
EXPOSE 80

# Start application
CMD ["sh", "-c", "php -S 0.0.0.0:8080 -t /var/www & nginx -g 'daemon off;'"]
