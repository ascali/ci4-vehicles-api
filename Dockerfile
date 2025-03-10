# Base image
FROM ubuntu:24.04

USER root

# Install dependencies
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.3 php8.3-cli php8.3-fpm php8.3-mysql php8.3-xml php8.3-mbstring php8.3-zip php8.3-curl php8.3-intl php8.3-gd php8.3-opcache php8.3-bcmath php8.3-soap php8.3-redis php8.3-sqlite3 apache2 libapache2-mod-php8.3 curl nano && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    a2enmod rewrite

# Copy CI4 application
WORKDIR /var/www/html
COPY . .

# Set permissions for CI4
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html && chmod -R 775 /var/www/html/writable

# Configure Apache to serve CI4
COPY deploy/apache.conf /etc/apache2/sites-available/000-default.conf

COPY deploy/php.ini /usr/local/etc/php/conf.d/php.ini

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]