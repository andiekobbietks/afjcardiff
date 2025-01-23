FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    sudo \
    default-mysql-server \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Configure sudo
RUN echo "gitpod ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

# Configure MySQL
RUN mkdir -p /var/run/mysqld && \
    chown -R mysql:mysql /var/run/mysqld && \
    mkdir -p /var/lib/mysql && \
    chown -R mysql:mysql /var/lib/mysql

# Initialize MySQL data directory
RUN mysql_install_db --user=mysql --datadir=/var/lib/mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install live-server
RUN npm install -g live-server

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose ports
EXPOSE 8000 3306 8080

# Start services
CMD ["sh", "-c", "service mysql start && mysqld_safe --skip-grant-tables & sleep 5 && mysql -u root -e \"CREATE DATABASE IF NOT EXISTS afjcardiff; FLUSH PRIVILEGES;\" && php -S 0.0.0.0:8000 -t /var/www/html/"]
