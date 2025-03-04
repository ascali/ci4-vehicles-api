# Base image
FROM ubuntu:24.04

USER root

# Install dependencies
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-zip php8.1-curl php8.1-intl php8.1-gd php8.1-opcache php8.1-bcmath php8.1-soap php8.1-redis php8.1-sqlite3 apache2 libapache2-mod-php8.1 curl nano && \
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