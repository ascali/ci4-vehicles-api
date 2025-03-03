# Base image
FROM ubuntu:22.04

# Install dependencies
RUN apt-get update && \
    apt-get install -y openvpn curl apache2 php libapache2-mod-php php-mysql php-curl php-json php-mbstring php-xml php-zip supervisor && \
    apt-get clean

# Copy OpenVPN configuration and auth file
COPY vpn-config.ovpn /etc/openvpn/vpn-config.ovpn
COPY vpn-auth.txt /etc/openvpn/vpn-auth.txt

# Copy CI4 application
WORKDIR /var/www/html
COPY . .

# Set permissions for CI4
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Configure Apache to serve CI4
RUN a2enmod rewrite && \
    sed -i 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord"]