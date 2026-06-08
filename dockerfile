FROM php:8.3-apache

# 1. Pasang ekstensi yang diwajibkan oleh Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# 2. Aktifkan mod_rewrite Apache (Wajib agar URL Laravel berfungsi)
RUN a2enmod rewrite

# 3. Ubah arah pintu masuk website ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Suntikkan Composer ke dalam mesin
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer