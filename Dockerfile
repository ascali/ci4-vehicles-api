# Base image
FROM ubuntu:22.04
USER root
# Set environment variables to avoid interactive prompts
ENV DEBIAN_FRONTEND=noninteractive

# Install dependencies
RUN apt-get update && \
    apt-get install -y openvpn curl apache2 php libapache2-mod-php php-mysql php-curl php-json php-mbstring php-xml php-zip supervisor && \
    apt-get clean

# Set timezone
RUN ln -fs /usr/share/zoneinfo/Asia/Jakarta /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

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

# Configure supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord"]