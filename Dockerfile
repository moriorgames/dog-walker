FROM php:7.2-apache-stretch

RUN apt-get update && apt-get install -y git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

RUN mkdir -p /app

WORKDIR /app

CMD ["apache2-foreground"]
