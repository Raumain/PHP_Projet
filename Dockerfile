FROM php:8.2-apache

# Install necessary tools and extensions
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Copy your source code and migration script
COPY . /var/www/html

# Run the migration script
RUN php src/db/migration.php

# Expose port  80 for the web server
EXPOSE  80


