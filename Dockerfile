FROM php:8.3-apache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
 
COPY index.php /var/www/html/

RUN apt update
RUN apt install git -y

# RUN composer install

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql


