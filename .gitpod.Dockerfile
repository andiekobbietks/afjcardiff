FROM gitpod/workspace-full

ENV DEBIAN_FRONTEND noninteractive

RUN sudo add-apt-repository ppa:ondrej/php && \
    sudo apt-get update && \
    sudo apt-get install -y \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-cli \
    php8.2-curl \
    php8.2-xml \
    php8.2-mbstring \
    php8.2-zip \
    php8.2-gd \
    php8.2-intl \
    php8.2-soap \
    php8.2-bcmath \
    php8.2-redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN sudo a2enmod rewrite

# Install MongoDB
RUN sudo apt-get update && \
    sudo apt-get install -y mongodb

# Add any additional configuration here if needed
