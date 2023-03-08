FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu && \
    apt-get -y install libmcrypt-dev && \
    apt-get -y install libsodium-dev && \
    apt-get -y install vim && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl sodium pdo_pgsql pgsql mysqli pdo pdo_mysql && \
    docker-php-ext-enable apcu pdo_pgsql  && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

ADD ./ /var/www
ADD ./.env.example .env
RUN chmod 777 -R storage/

RUN alias composer='php /usr/bin/composer'
RUN composer install
# RUN php artisan migrate

EXPOSE 9000