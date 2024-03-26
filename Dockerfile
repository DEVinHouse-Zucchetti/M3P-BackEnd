FROM php:8.3-fpm

RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev default-mysql-client curl gnupg procps vim git unzip libzip-dev libpq-dev \
  && docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql

RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

# pcov
RUN pecl install pcov && docker-php-ext-enable pcov

# Xdebug
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& echo ";zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

WORKDIR /var/www
EXPOSE 8000
