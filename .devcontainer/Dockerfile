FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    git \
    unzip \
    curl \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install live-server
RUN npm install -g live-server

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /workspace/afjcardiff

# Copy existing application directory contents
COPY . /workspace/afjcardiff

# Install PHP dependencies
RUN composer install

# Expose ports
EXPOSE 8000 3306 8080

# Start services
CMD ["sh", "-c", "service mysql start && php -S 0.0.0.0:8000 -t /workspace/afjcardiff"]
