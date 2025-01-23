FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    unzip \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install phpMyAdmin manually from official source
RUN curl -O https://files.phpmyadmin.net/phpMyAdmin/5.2.1/phpMyAdmin-5.2.1-all-languages.tar.gz \
    && tar xvf phpMyAdmin-5.2.1-all-languages.tar.gz \
    && mv phpMyAdmin-5.2.1-all-languages /var/www/html/phpmyadmin \
    && rm phpMyAdmin-5.2.1-all-languages.tar.gz \
    && mkdir -p /var/lib/phpmyadmin/tmp \
    && chown -R www-data:www-data /var/lib/phpmyadmin \
    && cp /var/www/html/phpmyadmin/config.sample.inc.php /var/www/html/phpmyadmin/config.inc.php

# Set working directory
WORKDIR /workspace/afjcardiff

# Copy application files
COPY . /workspace/afjcardiff/

# Set permissions
RUN chown -R www-data:www-data /workspace/afjcardiff \
    && chmod -R 755 /workspace/afjcardiff

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose ports
EXPOSE 8000 3306

# Start Apache
CMD ["apache2-foreground"]
