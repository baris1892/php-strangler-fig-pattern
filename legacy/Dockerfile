FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev zip unzip \
 && docker-php-ext-install session \
 && pecl install redis \
 && docker-php-ext-enable redis \
 && echo "session.save_handler = redis" > /usr/local/etc/php/conf.d/redis-session.ini \
 && echo "session.save_path = 'tcp://redis:6379?prefix=sess_'" >> /usr/local/etc/php/conf.d/redis-session.ini \
 && echo "session.serialize_handler = php" >> /usr/local/etc/php/conf.d/redis-session.ini \
 && echo "session.name = PHPSESSID" >> /usr/local/etc/php/conf.d/redis-session.ini

WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
