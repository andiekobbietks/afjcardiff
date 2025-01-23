FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install live-server
RUN npm install -g live-server

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install phpMyAdmin
RUN apt-get update && apt-get install -y phpmyadmin

# Configure Apache to serve phpMyAdmin
RUN ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin

# Set working directory
WORKDIR /workspace/afjcardiff

# Copy only necessary files to minimize build context
COPY composer.json composer.lock /workspace/afjcardiff/
COPY public /workspace/afjcardiff/public
COPY src /workspace/afjcardiff/src
COPY .env /workspace/afjcardiff/.env
COPY SQLDatabase /workspace/afjcardiff/SQLDatabase
COPY startup.sh /workspace/afjcardiff/startup.sh

# Set permissions
RUN chown -R www-data:www-data /workspace/afjcardiff \
    && chmod -R 755 /workspace/afjcardiff

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose ports
EXPOSE 8000 8080

# Start services
CMD ["sh", "-c", "php -S 0.0.0.0:8000 -t /workspace/afjcardiff/"]
