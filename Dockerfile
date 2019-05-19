FROM php:7.2-apache-stretch

RUN apt-get update && apt-get install -y git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN mkdir -p /app

WORKDIR /app

COPY . .

RUN php phars/composer.phar install
# For production
#RUN php phars/composer.phar install --optimize-autoloader

CMD ["apache2-foreground"]
