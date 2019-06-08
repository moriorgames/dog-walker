FROM php:7.2-apache-stretch

ARG XDEBUG_VERSION=2.6.0

RUN apt-get update && apt-get install -y git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug-${XDEBUG_VERSION}; \
    docker-php-ext-enable xdebug;

RUN a2enmod rewrite

RUN mkdir -p /app

WORKDIR /app

COPY . .

RUN adduser www-data www-data
RUN usermod -u 1000 www-data
RUN chown -R www-data:www-data /app/var

RUN php phars/composer.phar install

CMD ["apache2-foreground"]
