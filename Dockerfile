# mvc-schedule — PHP 8.4 + Apache
FROM php:8.4-apache

# Расширения PHP: PDO MySQL, Redis + расширения для Symfony/Illuminate
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql zip mbstring dom \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# mod_rewrite для Apache
RUN a2enmod rewrite

# DocumentRoot — public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Права на запись для логов и кэша
RUN mkdir -p /var/www/html/tmp/logs /var/www/html/tmp/cache /var/www/html/public/uploads \
    && chown -R www-data:www-data /var/www/html/tmp /var/www/html/public/uploads

WORKDIR /var/www/html

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Код (vendor в .dockerignore — ставим внутри контейнера)
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --ignore-platform-reqs \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80
