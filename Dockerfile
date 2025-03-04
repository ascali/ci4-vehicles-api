# Base image
FROM ubuntu:24.04

USER root

# Install dependencies
RUN apt-get update && \
    apt-get install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-zip php8.1-curl php8.1-intl php8.1-gd php8.1-opcache php8.1-bcmath php8.1-soap php8.1-redis php8.1-sqlite3 apache2 libapache2-mod-php8.1 openvpn curl supervisor nano && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Copy OpenVPN configuration and auth file
COPY deploy/vpn-config.ovpn /etc/openvpn/vpn-config.ovpn
COPY deploy/vpn-auth.txt /etc/openvpn/vpn-auth.txt
RUN chmod -R 775 /etc/openvpn/vpn-auth.txt

# Copy CI4 application
WORKDIR /var/www/html
COPY . .

# Set permissions for CI4
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html && chmod -R 777 /var/www/html/writable

# Configure Apache to serve CI4
COPY deploy/apache.conf /etc/apache2/sites-available/000-default.conf

COPY deploy/php.ini /usr/local/etc/php/conf.d/php.ini

# Configure supervisord
COPY deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Add OpenVPN to supervisord configuration
RUN echo "[program:openvpn]\ncommand=/usr/sbin/openvpn --config /etc/openvpn/vpn-config.ovpn --auth-user-pass /etc/openvpn/vpn-auth.txt\nautostart=true\nautorestart=true\nstderr_logfile=/var/log/openvpn.err.log\nstdout_logfile=/var/log/openvpn.out.log" >> /etc/supervisor/conf.d/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord"]
