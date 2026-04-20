FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       mariadb-client \
    && docker-php-ext-install mysqli \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
