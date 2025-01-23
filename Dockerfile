FROM gitpod/workspace-full

# Install core web development essentials
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    git \
    unzip \
    curl

# Install PHP extensions for MySQL connectivity
RUN docker-php-ext-install pdo_mysql

# Install Composer for PHP dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Add PHP repository and install phpMyAdmin
RUN apt-get update && \
    apt-get install -y ca-certificates apt-transport-https software-properties-common wget && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y phpmyadmin

# Configure Apache to serve phpMyAdmin and set up ports
RUN echo "Include /etc/phpmyadmin/apache.conf" >> /etc/apache2/apache2.conf
