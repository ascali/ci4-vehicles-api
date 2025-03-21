# Gunakan base image frankenphp
FROM dunglas/frankenphp:latest AS frankenphp

# Set user root
USER root

# Argument untuk environment base64
ARG ENV_BASE64

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential openssl \
    libfreetype6-dev libjpeg62-turbo-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev \
    libpq5 libpq-dev \
    libicu-dev \
    libgmp-dev \
    gcc g++ make vim zip unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* /tmp/pear/*

# Konfigurasi dan install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mysqli mbstring exif sockets pcntl bcmath intl gmp \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable opcache mysqli

# Copy project files
WORKDIR /var/www
COPY . /var/www

# Copy custom PHP configuration
COPY ./deploy/local.ini /usr/local/etc/php/php.ini

# Decode base64 environment file jika ada
RUN if [ -n "$ENV_BASE64" ]; then \
        echo -n "$ENV_BASE64" | base64 --decode > /var/www/.env; \
    elif [ ! -f "/var/www/.env" ] && [ -f "/var/www/env.exp" ]; then \
        cp /var/www/env.exp /var/www/.env; \
    else \
        echo "Skipping .env setup"; \
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

# Expose port
EXPOSE 8080

# Start application
CMD ["sh", "-c", "frankenphp php-server --listen 0.0.0.0:8080"]