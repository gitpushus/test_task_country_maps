FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
	libzip-dev \
	zip \
	&& docker-php-ext-install pdo_mysql zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html