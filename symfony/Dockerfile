FROM php:8.3-apache

RUN apt-get update && apt-get install -y git unzip curl libicu-dev libzip-dev \
    && pecl install redis \
    && docker-php-ext-enable redis \
    # important: enforce session settings
    && echo "session.save_handler = redis" > /usr/local/etc/php/conf.d/redis-session.ini \
    && echo "session.save_path = 'tcp://redis:6379?prefix=sess_'" >> /usr/local/etc/php/conf.d/redis-session.ini \
    && echo "session.serialize_handler = php" >> /usr/local/etc/php/conf.d/redis-session.ini \
    && echo "session.name = PHPSESSID" >> /usr/local/etc/php/conf.d/redis-session.ini \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY symfony.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
# start is handled via entrypoint.sh
CMD []