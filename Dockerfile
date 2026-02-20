# Use an official PHP image with Apache
FROM php:8.2-apache

# Install the MySQL extension so your PHP can talk to Aiven
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your API files and images into the web server directory
COPY . /var/www/html/

# Ensure the server can read the files
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for web traffic
EXPOSE 80