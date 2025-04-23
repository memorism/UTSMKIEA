# Pakai image PHP + Apache + Composer
FROM php:8.2-apache

# Install ekstensi MySQL & PDO
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy semua project Laravel ke dalam container
COPY . /var/www/html/

# Set working directory ke Laravel public
WORKDIR /var/www/html/

# Install depedensi Laravel
RUN composer install

# Kasih permission storage dan bootstrap (wajib di Laravel)
RUN chmod -R 775 storage bootstrap/cache

# Expose port 80 (buat Apache)
EXPOSE 80
