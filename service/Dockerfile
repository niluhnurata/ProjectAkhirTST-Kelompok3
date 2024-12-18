# Use official PHP with Apache image
FROM php:8.1-apache

# Install required packages for SOAP extension
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    && docker-php-ext-install soap \
    && apt-get clean

# Copy project files into the container
COPY . /var/www/html/soap

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
