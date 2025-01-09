FROM php:8.3-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    curl \
    nano \
    zip \
    libzip-dev \
    libicu-dev

# Enable Apache mod_rewrite for CodeIgniter
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy project files to the container
COPY . /var/www/html

# Set permissions for writable directories
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable \
    && chown -R www-data:www-data /var/www/html/public/uploads \
    && chmod -R 775 /var/www/html/public/uploads

# Configure Apache to serve the application
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Expose the application port
EXPOSE 80
