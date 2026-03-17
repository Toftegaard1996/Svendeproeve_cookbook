FROM php:8.4.8-apache AS initial

RUN apt-get update
RUN apt-get install -y git libicu-dev libpng-dev libjpeg-dev libpq-dev libonig-dev libzip-dev

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install zip
RUN docker-php-ext-install sockets
RUN docker-php-ext-install intl
RUN docker-php-ext-install gd
RUN pecl install -o -f redis
RUN docker-php-ext-enable redis
RUN mkdir /app 
RUN chown -R www-data:www-data /app
RUN a2enmod rewrite
RUN rm -rf /tmp/pear
RUN rm -rf /var/lib/apt/lists/*

COPY Docker/include/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY Docker/include/00-aliases.sh /root/.bashrc

FROM php:8.4.8-apache

WORKDIR /app

COPY --from=initial / /

EXPOSE 80
