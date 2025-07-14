FROM php:8.1-apache

# Install ekstensi PHP
RUN docker-php-ext-install pdo pdo_mysql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Salin file aplikasi ke container
COPY . /var/www/html/

# Set hak akses
RUN chown -R www-data:www-data /var/www/html/

# Gunakan custom vhost
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
