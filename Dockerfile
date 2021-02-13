FROM php:apache
RUN apt-get update
RUN apt-get install -y mariadb-client
RUN a2enmod rewrite
RUN docker-php-ext-install pdo_mysql
